<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idrol','nombre','apellido','telefono','direccion','usuario','password','estado','profile_picture'
    ];
    
    protected $appends = ['avatar'];
    
    protected $casts = [
      'profile_picture' => 'array'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function rol(){
        return $this->belongsTo('App\Rol');
    }
    
    public function getAvatarAttribute(){
      if( array_key_exists('url', $this->profile_picture ?: [] ) ){
        return '/' . $this->profile_picture['url'];
      }
      return '/img/avatar-default.png';
    }
}
