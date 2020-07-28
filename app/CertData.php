<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertData extends Model
{
    public $timestamps = false;

    public function cert(){
        return $this->belongsTo('App\Cert', 'cert_id');
    }
}
