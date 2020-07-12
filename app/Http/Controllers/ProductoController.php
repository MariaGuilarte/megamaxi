<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
class ProductoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

 
       
            $productos = Producto::join('categorias','productos.idcategoria','=','categorias.id')
            ->select('productos.id','productos.idcategoria','productos.codigo','productos.nombre','categorias.nombre as nombre_categoria','productos.precio_venta','productos.stock','productos.descripcion','productos.estado')
            ->where('productos.estado','=','registrado')
            ->orderBy('productos.id', 'asc')->paginate(100);
      

        return [
          
            'productos' => $productos
        ];
    }
     
        public function listarProducto(Request $request)
            {
                if (!$request->ajax()) return redirect('/');

       
            $productos = Producto::join('categorias','productos.idcategoria','=','categorias.id')
            ->select('productos.id','productos.idcategoria','productos.codigo','productos.nombre','categorias.nombre as nombre_categoria','productos.precio_venta','productos.stock','productos.descripcion','productos.estado')
            ->where('productos.estado','=','registrado')
            ->orderBy('productos.id', 'asc')->paginate(100);
        

                return [
                  
                    'productos' => $productos
                ];
            }




            public function ConteoProducto(Request $request)
            {
                if (!$request->ajax()) return redirect('/');

            $productos = Producto::where('estado','=','registrado')->count();
                 return  $productos; 
            }



            public function listarPDF(){

            $productos = Producto::join('categorias','productos.idcategoria','=','categorias.id')
            ->select('productos.id','productos.idcategoria','productos.codigo','productos.nombre','categorias.nombre as nombre_categoria','productos.precio_venta','productos.stock','productos.descripcion','productos.estado')
            ->orderBy('productos.nombre', 'desc')->get();

            $cont=Producto::count();
            $pdf = \PDF::loadView('pdf.productospdf',['productos'=>$productos, 'cont'=>$cont]);
            return $pdf->download('productos.pdf');
      
            }





     public function buscarProducto(Request $request){
      if (!$request->ajax()) return redirect('/');
      $filtro = $request->filtro;
      $productos = Producto::where('codigo','=',$filtro)
      ->select('id', 'nombre')->orderBy('nombre', 'asc')->take(1)->get();
      return ['productos' => $productos];

     }

     public function buscarProductoVenta(Request $request){
      if (!$request->ajax()) return redirect('/');
      $filtro = $request->filtro;
      $productos = Producto::where('codigo','=',$filtro)
      ->select('id', 'nombre','stock','precio_venta')
      ->where('stock','>','0')
      ->orderBy('nombre', 'asc')->take(1)->get();
      return ['productos' => $productos];

     }
     public function listarProductoVenta(Request $request)
            {
                if (!$request->ajax()) return redirect('/');

       
            $productos = Producto::join('categorias','productos.idcategoria','=','categorias.id')
            ->select('productos.id','productos.idcategoria','productos.codigo','productos.nombre','categorias.nombre as nombre_categoria','productos.precio_venta','productos.stock','productos.descripcion','productos.estado')
            ->where('productos.estado','=','registrado')
            ->where('productos.stock','>','0')
            ->orderBy('productos.id', 'asc')->paginate(100);
        

                return [
                  
                    'productos' => $productos
                ];
            }



    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $productos = new Producto();
        $productos->idcategoria = $request->idcategoria;
        $productos->codigo = $request->codigo;
        $productos->nombre = $request->nombre;
        $productos->precio_venta = $request->precio_venta;
        $productos->stock = $request->stock;
        $productos->descripcion = $request->descripcion;
        $productos->estado = 'registrado';
        $productos->save();
        
    }


    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $productos = Producto::findOrFail($request->id);
        $productos->idcategoria = $request->idcategoria;
        $productos->codigo = $request->codigo;
        $productos->nombre = $request->nombre;
        $productos->precio_venta = $request->precio_venta;
        $productos->stock = $request->stock;
        $productos->descripcion = $request->descripcion;
        $productos->estado = 'registrado';
        $productos->save();
    }

    public function delete(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $productos = Producto::findOrFail($request->id);
        $productos->estado = 'eliminado';
        $productos->save();
    }

}
