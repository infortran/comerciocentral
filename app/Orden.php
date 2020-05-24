<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    public function webpayOrdens(){
        return $this->hasOne('App\WebpayOrden', 'id_orden');
    }

    public function comprobantes(){
        return $this->hasOne('App\Comprobante', 'id_orden');
    }
}
