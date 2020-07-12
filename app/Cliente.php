<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre','apellido','tipo_documento','num_documento','direccion','telefono','email','estado'
    ];
}
