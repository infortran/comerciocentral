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
}
