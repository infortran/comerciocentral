<?php

namespace App\Http\Controllers;

use App\Producto;
use App\SiteSocial;
use App\Slide;
use Illuminate\Http\Request;
use App\HeaderFrontend;
use App\TeamMember;
use App\FooterInfo;
use App\Categoria;
use App\Marca;
use Session;

class InicioController extends Controller
{
    public function __construct(){

    }
	/*================================
			HOME FRONTEND
	==================================*/
    public function index(Request $request){
        $query = trim($request->get('search'));
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
    	return view('frontend.inicio', $data);
    }


    public function pkiValidation(Request $request, $key){
        echo 'FC82429374A6C78ED7A0EA8AA52E602322A6BB71387649B235F9056D49719A81
comodoca.com
ba4a31e804475fe';
    }
}
