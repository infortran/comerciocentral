<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    public function webpayOrdens(){
        return $this->hasOne('App\WebpayOrden');
    }

    public function comprobantes(){
        return $this->hasOne('App\Comprobante');
    }

    public function tienda(){
        return $this->belongsTo('App\Tienda');
    }

    public function mensaje(){
        return $this->hasOne('App\Mensaje');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
