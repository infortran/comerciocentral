<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DireccionUser extends Model
{
    public $timestamps = false;

    public function direccion(){
        return $this->belongsTo('App\Direccion');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
