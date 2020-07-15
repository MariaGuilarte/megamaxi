<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Ingreso;
use Carbon\Carbon;
use App\DetalleIngreso;
use App\User;
use Notification;
use App\Notifications\NotifyAdmin;

class IngresoController extends Controller
{
  public function index(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $ingresos = Ingreso::join('proveedores','ingresos.idproveedor','=','proveedores.id')
    ->join('users','ingresos.idusuario','=','users.id')
    ->select('ingresos.id','ingresos.tipo_comprobante','ingresos.serie_comprobante','ingresos.num_comprobante','ingresos.fecha_hora','ingresos.impuesto','ingresos.total','ingresos.estado','proveedores.nombre as nombre_proveedores','users.nombre as nombre_usuario','users.apellido' )
    ->orderBy('ingresos.id', 'asc')->paginate(100);
    return [
      'ingresos' => $ingresos
    ];
  }
  public function obtenerCabeceras(Request $request){
    if (!$request->ajax()) return redirect('/');
    $id = $request->id;
    $ingreso = Ingreso::join('proveedores','ingresos.idproveedor','=','proveedores.id')
    ->join('users','ingresos.idusuario','=','users.id')
    ->select('ingresos.id','ingresos.tipo_comprobante','ingresos.serie_comprobante','ingresos.num_comprobante','ingresos.fecha_hora','ingresos.impuesto','ingresos.total','ingresos.estado','proveedores.nombre as nombre_proveedores','users.nombre as nombre_usuario','users.apellido' )
    ->where('ingresos.id', '=', $id)
    ->orderBy('ingresos.id', 'asc')->take(1)->get();
    return [
      'ingreso' => $ingreso
    ];
  }
  public function obtenerDetalles(Request $request){
    if (!$request->ajax()) return redirect('/');
    $id = $request->id;
    $detalles = DetalleIngreso::join('productos','detalle_ingresos.idproducto','=','productos.id')
    ->select('detalle_ingresos.cantidad','detalle_ingresos.precio','productos.nombre as producto')
    ->where('detalle_ingresos.idingreso', '=', $id)
    ->orderBy('detalle_ingresos.id', 'asc')->get();
    return [
      'detalles' => $detalles
    ];
  }
  public function store(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    try{
      DB::beginTransaction();
      $mytime = Carbon::now('America/Lima');
      $usuario = \Auth::user();
      $ingresos = new Ingreso();
      $ingresos->idproveedor = $request->idproveedor;
      $ingresos->idusuario = \Auth::user()->id;
      $ingresos->tipo_comprobante = $request->tipo_comprobante;
      $ingresos->serie_comprobante = $request->serie_comprobante;
      $ingresos->num_comprobante = $request->num_comprobante;
      $ingresos->fecha_hora = $mytime->toDateTimeString();
      $ingresos->impuesto = $request->impuesto;
      $ingresos->total = $request->total;
      $ingresos->estado = 'registrado';
      $ingresos->save();
      $detalles = $request->data;
      foreach ($detalles as $ep => $det) {
        $detalle = new DetalleIngreso();
        $detalle->idingreso = $ingresos->id;
        $detalle->idproducto = $det['idproducto'];
        $detalle->cantidad = $det['cantidad'];
        $detalle->precio = $det['precio'];
        $detalle->save();
      }
      $fechaActual = date('Y-m-d');
      DB::commit();
      
      $numIngresos = DB::table('ingresos')->whereDate('fecha_hora', $fechaActual)->count();
      $notification_ingresos = [
        'type' => 'ingresos',
        'numero' => $numIngresos,
        'usuario'  => ['nombre' => $usuario->nombre, 'apellido' => $usuario->apellido]        
      ];
      Notification::send(User::all(), new NotifyAdmin($notification_ingresos));
    } catch(Exception $e){
      DB::rollBack();
    }
  }
  public function ConteoIngresos(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $ingreso = Ingreso::where('estado','=','registrado')->count();
    return  $ingreso;  
  }
  public function desactivar(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $ingresos = Ingreso::findOrFail($request->id);
    $ingresos->estado = 'anulado';
    $ingresos->save();
  }
}
