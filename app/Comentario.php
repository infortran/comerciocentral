<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function post(){
        return $this->hasOne('App\ComentarioPost');
    }

    public function comentarioproducto(){
        return $this->hasOne('App\ComentarioProducto');
    }
}
