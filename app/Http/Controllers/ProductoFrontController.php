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
        /*dd('se fue pa otro lado');
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
        return view('frontend.productos', $this->data);*/
        $domain = request()->route('domain');
        //dd($domain);
        if($domain) {
            $loader = new Loader($domain);
            //dd($loader->checkDominio());
            if ($loader->checkDominio()) {
                $loader->checkDominioAdmin();
                $data = $loader->getData();
                $data['categorias'] = Categoria::where('tienda_id', $data['tienda']->id)->get();
                $data['marcas'] = Marca::where('tienda_id', $data['tienda']->id)->get();
                $data['productos'] = Producto::where('tienda_id', $data['tienda']->id)->get();
                $data['producto_banner_primary'] = Producto::find(4);
                //dd($data['productos']);
                return view('frontend.productos', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

    public function single(Request $request, $domain, $id){
        $domain = request()->route('domain');
        //dd($domain);
        if($domain) {
            $loader = new Loader($domain);
            //dd($loader->checkDominio());
            if ($loader->checkDominio()) {
                $loader->checkDominioAdmin();
                $data = $loader->getData();
                //dd($id);
                $producto = Producto::find($id);
                //dd($producto);
                $data['rating'] = 0;
                $data['categorias'] = Categoria::where('tienda_id', $data['tienda']->id);
                $data['marcas'] = Marca::where('tienda_id', $data['tienda']->id);
                $data['producto'] = $producto;
                return view('frontend.producto-detalle', $data);
            }
        }
        return view('frontend.templates.site-not-found');
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
