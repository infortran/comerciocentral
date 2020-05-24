<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comprobante extends Model
{
    public function ordens(){
        return $this->belongsTo('App\Orden', 'id_orden');
    }
}
