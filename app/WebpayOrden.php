<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebpayOrden extends Model
{
    public function ordens(){
        return $this->belongsTo('App\Orden');
    }
}
