<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\FooterInfo;
use App\HeaderFrontend;
use App\Loader;
use App\Marca;
use App\Producto;
use App\RatingProducto;
use App\SiteSocial;
use App\TeamMember;
use App\Tienda;
use Illuminate\Http\Request;

class ProductoFrontController extends Controller
{
    private $data;

    public function __construct()
    {

    }

    public function index(Request $request, $domain){
        if($domain) {
            $loader = new Loader($domain);
            if ($loader->checkDominio()) {
                $loader->checkDominioAdmin();
                $data = $loader->getData();
                $query = trim($request->get('search'));
                if($request){
                    if($request->get('categoria')) {
                        $data['productos'] = $data['tienda']->productos()->where('categoria_id', $request->get('categoria'))->paginate(9);
                    }elseif($request->get('marca')){
                        $data['productos'] = $data['tienda']->productos()->where('marca_id', $request->get('marca'))->paginate(9);
                    }else{
                        $data['productos'] = $data['tienda']->productos()->where('nombre', 'LIKE', '%' . $query . '%')->orderBy('id', 'asc')->paginate(9);
                    }
                }
                $data['search'] = $query;
                return view('frontend.productos', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

    public function single(Request $request, $domain, $id){
        if($domain) {
            $loader = new Loader($domain);
            if ($loader->checkDominio()) {
                $loader->checkDominioAdmin();
                $data = $loader->getData();
                $producto = Producto::findOrFail($id);
                $data['producto'] = $producto;
                $data['promedio'] = $this->promedio($producto);
                return view('frontend.producto-detalle', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

    public static function promedio($producto){
        $suma = 0;
        foreach($producto->ratings as $rating){
            $suma += $rating->rating->voto;
        }
        if(count($producto->ratings) > 0){
            return $suma / count($producto->ratings);
        }
        return 0;
    }

    public function rangoPrecios(Request $request, $domain){
        if($request->ajax()){
            $tiendaID = $request->get('tienda');
            $min = $request->get('min');
            $max = $request->get('max');
            $tienda = Tienda::findOrFail($tiendaID);
            $productos['productos'] = $tienda->productos()->whereBetween('precio', [$min, $max])->orderBy('precio', 'asc')->get();
            $productos['domain'] = $domain;
            return view('frontend.templates.productos', $productos)->render();
        }
        return abort(404);
    }

}
