<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class Post extends Model
{
    public function tiendas(){
        return $this->belongsTo('App\Tienda', 'tienda_id');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function postratings(){
        return $this->hasMany('App\PostRating');
    }

    public function comentarios(){
        return $this->hasMany('App\Comentario');
    }
}
