<?php

namespace App\Http\Controllers;

use App\Loader;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function index(){

    }

    public function promos(Request $request, $domain){
        if($domain){
            $loader = new Loader($domain);
            if($loader->checkDominioAdmin()){
                $data = $loader->getData();
                return view('backend.promos.index', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

    public function create(){

    }

    public function store(){

    }

    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
