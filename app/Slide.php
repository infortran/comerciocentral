<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    public $timestamps = false;
    public function productos(){
        return $this->belongsTo('App\Producto', 'producto_id');
    }
}
