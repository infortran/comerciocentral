<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{

    public function productos(){
        return $this->hasMany('App\Producto');
    }

    public function slides(){
        return $this->hasMany('App\Slide');
    }

    public function mensajes(){
        return $this->hasMany('App\Mensaje');
    }

    public function socials(){
        return $this->belongsToMany('App\Social');
    }

    public function teammembers(){
        return $this->hasMany('App\TeamMember');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function clientes(){
        return $this->belongsToMany('App\User', 'cliente_tienda')->withTimestamps()->withPivot('cliente');
    }

    public function colortheme(){
        return $this->hasOne('App\ColorTheme');
    }

    public function banners(){
        return $this->hasMany('App\Banner', 'tienda_id');
    }

    public function posts(){
        return $this->hasMany('App\Post', 'tienda_id');
    }

    public function cert(){
        return $this->hasOne('App\Cert', 'tienda_id');
    }

    public function direccion(){
        return $this->belongsToMany('App\Direccion');
    }

    public function deliveries(){
        return $this->hasMany('App\Delivery');
    }

    public function ratings(){
        return $this->hasMany('App\RatingTienda');
    }

    public function asidebanner(){
        return $this->hasOne('App\AsideBanner');
    }

    public function productobanner(){
        return $this->hasOne('App\ProductoBanner');
    }

    public function categorias(){
        return $this->hasMany('App\Categoria');
    }

    public function marcas(){
        return $this->hasMany('App\Marca');
    }

    public function envios(){
        return $this->hasMany('App\Envio');
    }

    public function ordenes(){
        return $this->hasMany('App\Orden');
    }
}
