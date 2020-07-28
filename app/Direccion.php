<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    public $timestamps = false;

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function tienda(){
        return $this->belongsToMany('App\Tienda', '');
    }
}
