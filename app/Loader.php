<?php

namespace App;

use Session;

class Loader{

    private $dominio;

    public function __construct($dominio){
        $this->dominio = $dominio;
    }

    public function getData()
    {
        $tienda = Tienda::where('dominio', $this->dominio)->first();
        //Session::put('tienda', $tienda);
        $data = [
            'domain' => $this->dominio,
            'tienda' => $tienda,
            'members' => TeamMember::where('tienda_id', $tienda->id),
            'siteSocials' => SiteSocial::where('tienda_id', $tienda->id)
        ];
        return $data;
    }

    public function checkDominio(){
        $check = Tienda::where('dominio', $this->dominio)->get();
        if(count($check) > 0){
            return true;
        }
        return false;
    }
}
