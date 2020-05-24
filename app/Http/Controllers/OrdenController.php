<?php

namespace App\Http\Controllers;

use App\Loader;
use App\Orden;
use Carbon\Carbon;
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
        //NECESITO SOLO LAS ORDENES DEL DIA
        if($request){
            $ordenes = Orden::whereDate('created_at', Carbon::today())->paginate(10);
            $countOrdenes = $ordenes->count();
            $this->data['search'] = null;
            $this->data['ordenes'] = $ordenes;
            $this->data['count_ordenes'] = $countOrdenes;
        }
        $query = trim($request->get('search'));
        if($query){
            $ordenes = Orden::where('id', $query)->orderBy('id', 'desc')->paginate(10);
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
