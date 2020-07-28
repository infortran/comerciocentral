<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    Public function slide(){
        return $this->hasOne('App\Slide');
    }

    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }

    public function marca(){
        return $this->belongsTo('App\Marca');
    }

    public function banners(){
        return $this->hasMany('App\Banner', 'producto_id');
    }

    public function ratings(){
        return $this->belongsToMany('App\Rating');
    }

    public function tienda(){
        return $this->belongsTo('App\Tienda');
    }

    public function asidebanner(){
        return $this->hasOne('App\AsideBanner');
    }

    public function productobanner(){
        return $this->hasOne('App\ProductoBanner');
    }
}
