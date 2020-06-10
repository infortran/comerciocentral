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
        //Session::put('tienda', $tienda);
        $data = [
            'domain' => $this->dominio,
            'tienda' => $tienda,
            'members' => TeamMember::where('tienda_id', $tienda->id),
            'siteSocials' => SiteSocial::where('tienda_id', $tienda->id),
            'is_owner' => $this->isOwner
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

    public function checkDominioAdmin(){
        $check = Tienda::where('dominio', $this->dominio)->get();
        $tienda = $check->first();
        //dd($tienda);
        if(Auth::check()){
            if(count($check) > 0 && $tienda->user_id === Auth::user()->id){
                $this->isOwner = true;
                return true;
            }
            return false;
        }
        return false;
    }
}
