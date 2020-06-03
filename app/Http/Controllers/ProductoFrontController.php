<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\FooterInfo;
use App\HeaderFrontend;
use App\Loader;
use App\Marca;
use App\Producto;
use App\Rating;
use App\SiteSocial;
use App\TeamMember;
use Illuminate\Http\Request;

class ProductoFrontController extends Controller
{
    private $data;

    public function __construct()
    {
        /*$loader = new Loader();
        $this->data = $loader->getData();
        $this->data['categorias'] = Categoria::all();
        $this->data['marcas'] = Marca::all();
        $this->data['productos'] = Producto::all();*/
    }

    public function index(Request $request){
        dd('se fue pa otro lado');
        $query = trim($request->get('search'));
        if($request){
            $this->data['productos'] = Producto::where('nombre', 'LIKE', '%' . $query . '%')
                ->orWhere('descripcion', 'LIKE', '%' . $query . '%')->orderBy('id', 'asc')->paginate(9);
        }
        if($request->get('marca')){
            $this->data['productos'] = Producto::where('marca', $request->get('marca'))->orderBy('id', 'asc')->paginate(9);
        }

        if($request->get('categoria')){
            $this->data['productos'] = Producto::where('id_categoria', $request->get('categoria'))->orderBy('id', 'asc')->paginate(9);
        }
        $this->data['search'] = $query;
        return view('frontend.productos', $this->data);
    }

    public function single(Request $request, $id){
        $producto = Producto::findOrFail($id);
        $this->data['rating'] = $this->getPuntaje($id);
        $this->data['producto'] = $producto;
        return view('frontend.producto-detalle', $this->data);
    }

    public function getPuntaje($id){
        $puntajes = Rating::where('id_producto', $id)->get();
        $count = $puntajes->count();
        $suma = 0;
        $promedio = 0;
        foreach ($puntajes as $puntaje){
            $suma += $puntaje->voto;
        }
        if($suma > 0){
            $promedio = $suma / $count;
        }
        return $promedio;
    }
}
