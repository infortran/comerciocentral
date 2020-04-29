<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSocial extends Model
{
    public $timestamps = false;

    public function socials(){
        return $this->belongsTo('App\Social', 'id_social');
    }
}
