<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
class CategoriaController extends Controller
{
    //
     public function index(Request $request)
    {
      if (!$request->ajax()) return redirect('/');

            $categorias = Categoria::where('estado','=','1')->orderBy('categorias.id', 'asc')->paginate(100);

      
        
       
        return [
     
          'categorias' => $categorias
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

       

        $categorias = new Categoria();
        $categorias->nombre = $request->nombre;
        $categorias->descripcion = $request->descripcion;
        $categorias->estado = '1';
        $categorias->save();
        
    }

     public function ConteoCategoria(Request $request)
            {
                if (!$request->ajax()) return redirect('/');
            $categoria = Categoria::where('estado','=','1')->count();
                 return  $categoria;  
            }


    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categorias = Categoria::findOrFail($request->id);
        $categorias->nombre = $request->nombre;
        $categorias->descripcion = $request->descripcion;
        $categorias->estado = '1';
        $categorias->save();
    }

    public function delete(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categorias = Categoria::findOrFail($request->id);
        $categorias->estado = '2';
        $categorias->save();
    }

     public function selectcategoria(Request $request){
        if (!$request->ajax()) return redirect('/');
        $categorias = Categoria::select('id','nombre')->orderBy('nombre', 'asc')->get();
        return ['categorias' => $categorias];
    }
}
