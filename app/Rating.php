<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function productos(){
        return $this->belongsToMany('App\Producto');
    }

    public function posts(){
        return $this->belongsToMany('App\Post');
    }

    public function tiendas(){
        return $this->belongsToMany('App\Tienda');
    }
}
