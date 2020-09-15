<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoRating extends Model
{
    public $timestamps = false;

    public function rating(){
        return $this->belongsTo('App\Rating');
    }

    public function producto(){
        return $this->belongsTo('App\Producto');
    }
}
