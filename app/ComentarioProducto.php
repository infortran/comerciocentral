<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComentarioProducto extends Model
{
    public $timestamps = false;

    public function comentario(){
        return $this->belongsTo('App\Comentario');
    }

    public function producto(){
        return $this->belongsTo('App\Producto');
    }
}
