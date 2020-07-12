<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
class ProveedorController extends Controller
{
    public function index(Request $request)
    {
       if (!$request->ajax()) return redirect('/');

            $proveedores = Proveedor::where('estado','=','1')->orderBy('proveedores.id', 'asc')->paginate(100);

      
        
       
        return [
     
          'proveedores' => $proveedores
        ];
    }


    public function selectproveedor( Request $request){
    if (!$request->ajax()) return redirect('/');

    $proveedores = Proveedor::select('id','nombre')
    ->orderBy('nombre', 'asc')->get();
    return ['proveedores' => $proveedores];


    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

       

        $proveedores = new Proveedor();
        $proveedores->nombre = $request->nombre;
        $proveedores->ruc = $request->ruc;
        $proveedores->direccion = $request->direccion;
        $proveedores->telefono = $request->telefono;
        $proveedores->email = $request->email;
        $proveedores->estado = '1';
        $proveedores->save();
        
    }

    public function ConteoProveedor(Request $request)
            {
                if (!$request->ajax()) return redirect('/');
            $proveedor = Proveedor::where('estado','=','1')->count();
                 return  $proveedor;  
            }


    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $proveedores = Proveedor::findOrFail($request->id);
        $proveedores->nombre = $request->nombre;
        $proveedores->ruc = $request->ruc;
        $proveedores->direccion = $request->direccion;
        $proveedores->telefono = $request->telefono;
        $proveedores->email = $request->email;
        $proveedores->estado = '1';
        $proveedores->save();
    }

    public function delete(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $proveedores = Proveedor::findOrFail($request->id);
        $proveedores->estado = '2';
        $proveedores->save();
    }

}
