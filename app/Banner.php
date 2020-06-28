<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public $timestamps = false;

    public function tiendas(){
        return $this->belongsTo('App\Tienda');
    }

    public function productos(){
        return $this->belongsTo('App\Producto', 'producto_id');
    }
}
