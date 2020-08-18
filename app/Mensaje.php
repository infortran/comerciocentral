<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function orden(){
        return $this->belongsTo('App\Orden');
    }

    public function tienda(){
        return $this->belongsTo('App\Tienda');
    }
}
