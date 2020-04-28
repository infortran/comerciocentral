<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    Public function slides(){
        return $this->hasMany('App\Slide');
    }

    public function marcas(){
        return $this->belongsTo('App\Marca', 'id_marca');
    }
}
