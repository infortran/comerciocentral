<?php

namespace App\Http\Controllers;

use App\Loader;
use App\Orden;
use Illuminate\Http\Request;

class OrdenController extends Controller
{
    private $data;
    public function __construct(){
        $this->middleware('admin');
        $loader = new Loader();
        $this->data = $loader->getData();
        $this->data['ordenes'] = Orden::all();

    }

    public function index(Request $request){
        $query = trim($request->get('search'));
        if($request){
            $ordenes = Orden::where('id','LIKE','%'. $query .'%')->orderBy('id', 'desc')->paginate(10);
            $this->data['search'] = $query;
            $this->data['ordenes'] = $ordenes;
        }
        return view('backend.ordenes.index', $this->data);
    }

    public function show($id){
        $orden = Orden::find($id);
        $this->data['orden'] = $orden;
        $this->data['cart'] = unserialize($orden->cart);
        return view('backend.ordenes.orden', $this->data);
    }
}
