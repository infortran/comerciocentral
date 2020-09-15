<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function postRating(){
        return $this->hasOne('App\PostRating');
    }

    public function productorating(){
        return $this->hasOne('App\ProductoRating');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
