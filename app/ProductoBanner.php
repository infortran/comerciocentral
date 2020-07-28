<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoBanner extends Model
{
    public $timestamps = false;

    public function producto(){
        return $this->belongsTo('App\Producto');
    }

    public function tienda(){
        return $this->belongsTo('App\Tienda');
    }
}
