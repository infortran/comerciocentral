<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RatingTienda extends Model
{
    protected $table = 'rating_tienda';
    public $timestamps = false;

    public function rating(){
        return $this->belongsTo('App\Rating');
    }
}
