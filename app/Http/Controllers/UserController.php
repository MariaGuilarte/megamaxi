<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
       if (!$request->ajax()) return redirect('/');

            $usuarios = User::join('roles','users.idrol','=','roles.id')
            ->select('users.id','users.idrol','users.nombre','users.apellido','users.telefono','users.direccion','users.usuario','users.password','roles.nombre as nombre_roles')
            ->where('estado','=','1')
            ->orderBy('users.id', 'asc')->paginate(100);

      
        
       
        return [
     
          'usuarios' => $usuarios
        ];
    }


public function cambiosgeneral(Request $request)
    {
       if (!$request->ajax()) return redirect('/');
            $id = \Auth::user()->id;
            $usuarios = User::where('estado','=','1')
            ->where('id','=',$id)->get();

      
        
       
        return [
     
          'usuarios' => $usuarios
        ];
    }

    public function actualizarcambiosgeneral(Request $request)
    {
        
        //if (!$request->ajax()) return redirect('/');
        $usuarios = Auth::user();
        $usuarios->idrol = $request->idrol;
        $usuarios->nombre = $request->nombre;
        $usuarios->apellido = $request->apellido;
        $usuarios->telefono = $request->telefono;
        $usuarios->direccion = $request->direccion;
        $usuarios->usuario = $request->usuario;
        $usuarios->password = (bcrypt( $request->password)) ?: $usuarios->password;
        $usuarios->estado = '1';
        $usuarios->save();

      
        
       
        return [
     
          'usuarios' => $usuarios
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

       

        $usuarios = new User();
        $usuarios->idrol = $request->idrol;
        $usuarios->nombre = $request->nombre;
        $usuarios->apellido = $request->apellido;
        $usuarios->telefono = $request->telefono;
        $usuarios->direccion = $request->direccion;
        $usuarios->usuario = $request->usuario;
        $usuarios->password = bcrypt( $request->password);
        $usuarios->estado = '1';
        $usuarios->save();
        
    }


    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $usuarios = User::findOrFail($request->id);
        $usuarios->idrol = $request->idrol;
        $usuarios->nombre = $request->nombre;
        $usuarios->apellido = $request->apellido;
        $usuarios->telefono = $request->telefono;
        $usuarios->direccion = $request->direccion;
        $usuarios->usuario = $request->usuario;
        $usuarios->password = bcrypt( $request->password);
        $usuarios->estado = '1';
        $usuarios->save();
    }


    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $usuarios = User::findOrFail($request->id);
        $usuarios->estado = '2';
        $usuarios->save();
    }

    public function usuariosinactivos(Request $request)
    {
       if (!$request->ajax()) return redirect('/');

            $usuarios = User::join('roles','users.idrol','=','roles.id')
            ->select('users.id','users.idrol','users.nombre','users.apellido','users.telefono','users.direccion','users.usuario','users.password','roles.nombre as nombre_roles')
            ->where('estado','=','2')
            ->orderBy('users.id', 'asc')->paginate(100);

      
        
       
        return [
     
          'usuarios' => $usuarios
        ];
    }

     public function borrarinactivos(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $usuarios = User::findOrFail($request->id);
        $usuarios->estado = '3';
        $usuarios->save();
    }

     public function activarusuarios(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $usuarios = User::findOrFail($request->id);
        $usuarios->estado = '1';
        $usuarios->save();
    }

}
