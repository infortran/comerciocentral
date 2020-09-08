<?php

namespace App;

use Session;
use Illuminate\Support\Facades\Auth;

class Loader{

    private $dominio, $isOwner, $certificado;

    public function __construct($dominio){
        $this->dominio = $dominio;
        $this->isOwner = false;
        $this->certificado = true;
    }

    public function getData()
    {
        $tienda = Tienda::where('dominio', $this->dominio)->first();
        $data = [
            'domain' => $this->dominio,
            'domain_owner' => false,
            'certificacion' => $this->certificado,
            'cartname' => 'cart-' . $tienda->id,
            'envioname' => 'envio-' . $tienda->id,
            'tienda' => $tienda,
            'is_owner' => $this->isOwner,
            'color_themes' => $tienda->colorthemes,
            'puntaje' => $this->getPuntajeTienda($tienda)
        ];
        return $data;
    }

    public function getPuntajeTienda($tienda){
        $suma = 0;
        foreach($tienda->ratings as $voto){
            $suma += $voto->rating->voto;
        }
        $resultado = 0;
        if($suma > 0){
            $resultado = $suma / count($tienda->ratings);
        }
        return $resultado;
    }

    public function getTienda(){
        return Tienda::where('dominio', $this->dominio)->first();
    }

    public function getTiendaByDomain($dominio){
        return Tienda::where('dominio', $this->dominio)->first();
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
