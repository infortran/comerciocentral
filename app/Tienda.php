<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    public function sitesocials(){
        return $this->belongsToMany('App\SiteSocial', 'tienda_id');
    }

    public function teammembers(){
        return $this->belongsToMany('App\TeamMember', 'tienda_id');
    }

    public function users(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function colorthemes(){
        return $this->hasMany('App\ColorTheme', 'tienda_id');
    }
}
