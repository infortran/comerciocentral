<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\FooterInfo;
use App\HeaderFrontend;
use App\Marca;
use App\Producto;
use App\Rating;
use App\SiteSocial;
use App\TeamMember;
use Illuminate\Http\Request;

class ProductoFrontController extends Controller
{
    private $categorias;
    private $marcas;
    private $productos;

    public function __construct()
    {
        $this->categorias = Categoria::all();
        $this->marcas = Marca::all();
        $this->productos = Producto::all();
    }

    public function index(Request $request){
        $query = trim($request->get('search'));
        if($request){
            $this->productos = Producto::where('nombre', 'LIKE', '%' . $query . '%')
                ->orWhere('descripcion', 'LIKE', '%' . $query . '%')->orderBy('id', 'asc')->paginate(9);
        }
        $data = [
            'header' => HeaderFrontend::find(1),
            'footer' => FooterInfo::find(1),
            'members' => TeamMember::all(),
            'siteSocials' => SiteSocial::all(),
            'categorias' => $this->categorias,
            'marcas' => $this->marcas,
            'productos' => $this->productos,
            'search' => $query
        ];
        return view('frontend.productos', $data);
    }

    public function single(Request $request, $id){
        $producto = Producto::findOrFail($id);

        $data = [
            'header' => HeaderFrontend::find(1),
            'footer' => FooterInfo::find(1),
            'members' => TeamMember::all(),
            'siteSocials' => SiteSocial::all(),
            'categorias' => $this->categorias,
            'marcas' => $this->marcas,
            'producto' => $producto,
            'rating' => $this->getPuntaje($id)
        ];
        return view('frontend.producto-detalle', $data);
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
