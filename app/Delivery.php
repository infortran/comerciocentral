<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    public $timestamps = false;

    public function tiendas(){
        return $this->belongsTo('App\Tienda');
    }
}
