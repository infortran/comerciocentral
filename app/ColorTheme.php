<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColorTheme extends Model
{
    public function tiendas(){
        return $this->belongsTo('App\Tienda', 'tienda_id');
    }
}
