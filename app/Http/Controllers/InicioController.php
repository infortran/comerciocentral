<?php

namespace App\Http\Controllers;

use App\Loader;
use App\Producto;
use App\SiteSocial;
use App\Slide;
use App\Tienda;
use Illuminate\Http\Request;
use App\HeaderFrontend;
use App\TeamMember;
use App\FooterInfo;
use App\Categoria;
use App\Marca;
use Session;
use Illuminate\Support\Facades\Auth;

class InicioController extends Controller
{

    public function index(Request $request, $domain){
        if($domain) {
            $loader = new Loader($domain);
            if ($loader->checkDominio()) {
                $loader->checkDominioAdmin();
                $data = $loader->getData();
                $query = trim($request->get('search'));
                if($request){
                    $data['productos'] = $data['tienda']->productos()->where('nombre', 'LIKE', '%'. $query . '%')->orderBy('created_at', 'desc')->paginate(9);
                }
                return view('frontend.inicio', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

}
