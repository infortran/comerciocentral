<?php

namespace App;

use Session;
use Illuminate\Support\Facades\Auth;

class Loader{

    private $dominio, $isOwner;

    public function __construct($dominio){
        $this->dominio = $dominio;
        $this->isOwner = false;
    }

    public function getData()
    {
        $tienda = Tienda::where('dominio', $this->dominio)->first();
        $data = [
            'domain' => $this->dominio,
            'cartname' => 'cart-' . $tienda->id,
            'envioname' => 'envio-' . $tienda->id,
            'tienda' => $tienda,
            'members' => TeamMember::where('tienda_id', $tienda->id),
            'siteSocials' => SiteSocial::where('tienda_id', $tienda->id),
            'is_owner' => $this->isOwner,
            'color_themes' => $tienda->colorthemes,
            'banners' => $tienda->banners
        ];
        foreach($tienda->banners as $banner){
            $data[$banner->nombre] = $banner;
        }
        return $data;
    }

    public function checkDominio(){
        $check = Tienda::where('dominio', $this->dominio)->get();
        if(count($check) > 0){
            return true;
        }
        return false;
    }

    public function checkDominioAdmin(){
        $tienda = Tienda::where('dominio', $this->dominio)->first();
        //dd($tienda);
        if(Auth::check()){
            if(count($tienda) > 0 && $tienda->user_id === Auth::user()->id){
                $this->isOwner = true;
                return true;
            }
            return false;
        }
        return false;
    }
}
