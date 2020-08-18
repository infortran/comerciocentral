<?php

namespace App\Http\Controllers;

use App\Loader;
use Illuminate\Http\Request;

class ColorThemeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index($domain){
        if($domain){
            $loader = new Loader($domain);
            if($loader->checkDominio()){
                $loader->checkDominioAdmin();
                $data = $loader->getData();
                return view('backend.colorthemes.index', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

    public function store(Request $request, $domain){
        if($domain){
            $loader = new Loader($domain);
            if($loader->checkDominioAdmin()){
                $tienda = $loader->getTienda();
                $theme = $tienda->colortheme;
                $theme->primario = $request->get('primario');
                $theme->secundario = $request->get('secundario');
                $theme->background = $request->get('background');
                $theme->texto = $request->get('texto');
                $theme->texto_claro = $request->get('texto-claro');
                $theme->texto_btn = $request->get('texto-btn');
                $tienda->colortheme ? $theme->save() : $tienda->colortheme()->save($theme);

                return redirect('admin/config/themes');
            }
        }
        return view('frontend.templates.site-not-found');
    }
}
