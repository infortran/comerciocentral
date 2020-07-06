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

	/*================================
			HOME FRONTEND
	==================================*/


    public function index(Request $request){

        $domain = request()->route('domain');
        if($domain) {
            $loader = new Loader($domain);
            //dd($loader->checkDominio());
            if ($loader->checkDominio()) {
                $loader->checkDominioAdmin();
                $data = $loader->getData();
                //dd($data['siteSocials']);
                $data['cartname'] = 'cart-'. $data['tienda']->id;
                $data['slides'] = Slide::where('tienda_id', $data['tienda']->id)->get();
                $data['categorias'] = Categoria::where('tienda_id', $data['tienda']->id)->get();
                $data['productos'] = Producto::where('tienda_id', $data['tienda']->id)->get();
                $data['marcas'] = Marca::where('tienda_id', $data['tienda']->id)->get();
                return view('frontend.inicio', $data);
            }
        }
        return view('frontend.templates.site-not-found');

        /*$query = trim($request->get('search'));
        $productos = Producto::all();
        if($request){
            $productos = Producto::where('nombre', 'LIKE', '%' . $query . '%')
                ->orWhere('descripcion', 'LIKE', '%' . $query . '%')->orderBy('id', 'asc')->paginate(9);
        }
        if(request('categoria')){
            $productos = Producto::where('id_categoria', request('categoria'))->orderBy('id', 'asc')->paginate(9);
        }
        if(request('marca')){
            $productos = Producto::where('id_marca', request('marca'))->orderBy('id', 'asc')->paginate(9);
        }
    	$data = [
    		'header' => HeaderFrontend::findOrFail(1),
    		'footer' => FooterInfo::findOrFail(1),
    		'members' => TeamMember::all(),
    		'categorias' => Categoria::all(),
    		'marcas' => Marca::all(),
            'productos' => $productos,
            'slides' => Slide::all(),
            'siteSocials' => SiteSocial::all(),
            'search' => $query];
    	return view('frontend.inicio', $data);*/
    }

}
