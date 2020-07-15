<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Venta;
use Carbon\Carbon;
use App\DetalleVenta;
use App\User;
use App\Notifications\NotifyAdmin;
use Notification;

class VentaController extends Controller
{
  public function index(Request $request){
    if( !$request->ajax() ) 
    return redirect('/');
    $ventas = Venta::join('clientes','ventas.idcliente','=','clientes.id')
    ->join('users','ventas.idusuario','=','users.id')
    ->select('ventas.id','ventas.tipo_comprobante','ventas.serie_comprobante','ventas.num_comprobante','ventas.fecha_hora','ventas.impuesto','ventas.total','ventas.estado','clientes.nombre as nombre_clientes','clientes.apellido as apellido_clientes','users.nombre as nombre_usuario','users.apellido' )
    ->orderBy('ventas.id', 'asc')->paginate(100);
    return ['ventas' => $ventas];
  }
  public function pdf(Request $request, $id){
    $venta = Venta::join('clientes','ventas.idcliente','=',
    'clientes.id')
    ->join('users','ventas.idusuario','=','users.id')
    ->select('ventas.id','ventas.tipo_comprobante','ventas.serie_comprobante','ventas.num_comprobante','ventas.fecha_hora','ventas.impuesto','ventas.total','ventas.estado','clientes.nombre as nombre_clientes','clientes.apellido as apellido_clientes','clientes.tipo_documento','clientes.num_documento','clientes.direccion','clientes.telefono','clientes.email','users.nombre as nombre_usuario','users.apellido' )
    ->where('ventas.id', '=', $id)
    ->orderBy('ventas.id', 'desc')->take(1)->get();
    $detalles = DetalleVenta::join('productos','detalle_ventas.idproducto','=','productos.id')
    ->select('detalle_ventas.cantidad','detalle_ventas.precio','detalle_ventas.descuento','productos.nombre as producto')
    ->where('detalle_ventas.idventa', '=', $id)
    ->orderBy('detalle_ventas.id', 'desc')->get();
    $numventa = Venta::select('num_comprobante')->where('id', $id)->get();
    $pdf      = \PDF::loadView('pdf.ventapdf',['venta'=>$venta, 'detalles'=>$detalles]);
    return $pdf->download('venta-'.$numventa[0]->num_comprobante.'.pdf');   
  }
  public function obtenerCabeceras(Request $request){
    if (!$request->ajax()) return redirect('/');
    $id = $request->id;
    $venta = Venta::join('clientes','ventas.idcliente','=','clientes.id')
    ->join('users','ventas.idusuario','=','users.id')
    ->select('ventas.id','ventas.tipo_comprobante','ventas.serie_comprobante','ventas.num_comprobante','ventas.fecha_hora','ventas.impuesto','ventas.total','ventas.estado','clientes.nombre as nombre_clientes','clientes.apellido as apellido_clientes','users.nombre as nombre_usuario','users.apellido' )
    ->where('ventas.id', '=', $id)
    ->orderBy('ventas.id', 'asc')->take(1)->get();
    return [
      'venta' => $venta
    ];
  }
  public function obtenerDetalles(Request $request){
    if (!$request->ajax()) return redirect('/');
    $id = $request->id;
    $detalles = DetalleVenta::join('productos','detalle_ventas.idproducto','=','productos.id')
    ->select('detalle_ventas.cantidad','detalle_ventas.precio','detalle_ventas.descuento','productos.nombre as producto')
    ->where('detalle_ventas.idventa', '=', $id)
    ->orderBy('detalle_ventas.id', 'desc')->get();
    return ['detalles' => $detalles];
  }
  public function store(Request $request){
    if( !$request->ajax() ) return redirect('/');
    try {
      DB::beginTransaction();
      $mytime = Carbon::now('America/Lima');
      $usuario = \Auth::user();
      $ventas = new Venta();
      $ventas->idcliente = $request->idcliente;
      $ventas->idusuario = \Auth::user()->id;
      $ventas->tipo_comprobante = $request->tipo_comprobante;
      $ventas->serie_comprobante = $request->serie_comprobante;
      $ventas->num_comprobante = $request->num_comprobante;
      $ventas->fecha_hora = $mytime->toDateTimeString();
      $ventas->impuesto = $request->impuesto;
      $ventas->total = $request->total;
      $ventas->estado = 'registrado';
      $ventas->save();
      $detalles = $request->data;
      foreach ($detalles as $ep => $det) {
        $detalle = new DetalleVenta();
        $detalle->idventa = $ventas->id;
        $detalle->idproducto = $det['idproducto'];
        $detalle->cantidad = $det['cantidad'];
        $detalle->precio = $det['precio'];
        $detalle->descuento = $det['descuento'];
        $detalle->save();
      }
      $fechaActual = date('Y-m-d');
      $numVentas   = DB::table('ventas')->whereDate('fecha_hora',$fechaActual)->count();
      $notification_data = [
        'type' => 'ventas',
        'numero' => $numVentas,
        'usuario'  => ['nombre' => $usuario->nombre, 'apellido' => $usuario->apellido]        
      ];
      Notification::send(User::all(), new NotifyAdmin($notification_data));
      DB::commit();
    } catch(Exception $e){
      DB::rollBack();
    }
  }
  public function ConteoVentas(Request $request){
    if (!$request->ajax()) return redirect('/');
    $venta = Venta::where('estado','=','registrado')->count();
    return  $venta;  
  }
  public function desactivar(Request $request){
    if (!$request->ajax()) return redirect('/');
    $ventas = Venta::findOrFail($request->id);
    $ventas->estado = 'anulado';
    $ventas->save();
  }
}
