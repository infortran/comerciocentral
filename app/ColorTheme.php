<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColorTheme extends Model
{

    public $timestamps = false;
    public function tienda(){
        return $this->belongsTo('App\Tienda');
    }
}
