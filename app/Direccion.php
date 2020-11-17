<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    public $timestamps = false;

    public function user(){
        return $this->hasOne('App\DireccionUser');
    }

    public function tienda(){
        return $this->hasOne('App\DireccionTienda');
    }
}
