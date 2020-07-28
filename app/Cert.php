<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cert extends Model
{
    public $timestamps = false;

    public function tienda(){
        return $this->belongsTo('App\Tienda', 'tienda_id');
    }

    public function certdata(){
        return $this->hasOne('App\CertData', 'cert_id');
    }
}
