<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
      if (!$request->ajax()) return redirect('/');

            $clientes = Cliente::where('estado','=','1')->orderBy('clientes.id', 'asc')->paginate(100);

      
        
       
        return [
     
          'clientes' => $clientes
        ];
    }

    public function selectcliente( Request $request){
    if (!$request->ajax()) return redirect('/');

    $clientes = Cliente::select('id','apellido')
    ->orderBy('apellido', 'asc')->get();
    return ['clientes' => $clientes];


    }

    public function store(Request $request)
    {
      if (!$request->ajax()) return redirect('/');
      
      $clientes = new Cliente();
      $clientes->nombre = $request->nombre;
      $clientes->apellido = $request->apellido;
      $clientes->tipo_documento = $request->tipo_documento;
      $clientes->num_documento = $request->num_documento;
      $clientes->direccion = $request->direccion;
      $clientes->telefono = $request->telefono;
      $clientes->email = $request->email;
      $clientes->estado = '1';
      $clientes->save();
    }

    public function ConteoCliente(Request $request)
            {
                if (!$request->ajax()) return redirect('/');
            $cliente = Cliente::where('estado','=','1')->count();
                 return  $cliente;  
            }


    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $clientes = Cliente::findOrFail($request->id);
        $clientes->nombre = $request->nombre;
        $clientes->apellido = $request->apellido;
        $clientes->tipo_documento = $request->tipo_documento;
        $clientes->num_documento = $request->num_documento;
        $clientes->direccion = $request->direccion;
        $clientes->telefono = $request->telefono;
        $clientes->email = $request->email;
        $clientes->estado = '1';
        $clientes->save();
    }

    public function delete(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $clientes = Cliente::findOrFail($request->id);
        $clientes->estado = '2';
        $clientes->save();
    }

}
