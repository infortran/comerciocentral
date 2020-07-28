<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsideBanner extends Model
{
    public $timestamps = false;

    public function tienda(){
        return $this->belongsTo('App\Tienda');
    }

    public function producto(){
        return $this->belongsTo('App\Producto');
    }
}
