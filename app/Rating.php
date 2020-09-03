<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function postRating(){
        return $this->hasOne('App\PostRating');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
