<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable =[
        'idcategoria','codigo','nombre','precio_venta','stock','descripcion','estado'
    ];

    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
}
