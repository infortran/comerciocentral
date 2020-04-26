<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\FooterInfo;
use App\HeaderFrontend;
use App\Marca;
use App\Producto;
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
            'categorias' => $this->categorias,
            'marcas' => $this->marcas,
            'productos' => $this->productos,
            'search' => $query
        ];
        return view('frontend.productos', $data);
    }
}
