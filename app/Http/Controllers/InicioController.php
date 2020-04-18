<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Slide;
use Illuminate\Http\Request;
use App\HeaderFrontend;
use App\TeamMember;
use App\FooterInfo;
use App\Categoria;
use App\Marca;

class InicioController extends Controller
{
	/*================================
			HOME FRONTEND
	==================================*/
    public function index(Request $request){
        $query = trim($request->get('search'));
        $productos = Producto::all();
        if($request){
            $productos = Producto::where('nombre', 'LIKE', '%' . $query . '%')->orderBy('id', 'asc')->paginate(9);
        }
    	$data = [
    		'header' => HeaderFrontend::findOrFail(1),
    		'footer' => FooterInfo::findOrFail(1),
    		'members' => TeamMember::all(),
    		'categorias' => Categoria::all(),
    		'marcas' => Marca::all(),
            'productos' => $productos,
            'slides' => Slide::all(),
            'search' => $query];
    	return view('frontend.inicio', $data);
    }
}
