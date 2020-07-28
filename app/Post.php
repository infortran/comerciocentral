<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class Post extends Model
{
    public function tiendas(){
        return $this->belongsTo('App\Tienda', 'tienda_id');
    }

    public function users(){
        return $this->belongsTo('App\User', 'id_usuario');
    }

    public function ratings(){
        return $this->belongsToMany('App\Rating');
    }
}
