<?php

namespace App\Http\Controllers;

use App\Loader;
use App\Orden;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrdenController extends Controller
{

    public function __construct(){
        $this->middleware('admin');
    }

    public function index(Request $request, $domain){
        if($domain) {
            $loader = new Loader($domain);
            //dd($loader->checkDominio());
            if ($loader->checkDominioAdmin()) {
                $data = $loader->getData();
                if($request){
                    $ordenes = Orden::whereDate('created_at', Carbon::today())->where('tienda_id', $data['tienda']->id)->paginate(10);
                    $countOrdenes = $ordenes->count();
                    $data['search'] = null;
                    $data['ordenes'] = $ordenes;
                    $data['count_ordenes'] = $countOrdenes;
                }
                $query = trim($request->get('search'));
                if($query){
                    $ordenes = Orden::where('id', $query)->orderBy('id', 'desc')->paginate(10);
                    $data['search'] = $query;
                    $data['ordenes'] = $ordenes;
                }
                return view('backend.ordenes.index', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

    public function show($domain ,$id){
        if($domain) {
            $loader = new Loader($domain);
            //dd($loader->checkDominio());
            if ($loader->checkDominioAdmin()) {
                $data = $loader->getData();
                $orden = Orden::findOrFail($id);
                $data['orden'] = $orden;
                $data['cart'] = unserialize($orden->cart);
                return view('backend.ordenes.orden', $data);
            }
        }
        return view('frontend.templates.site-not-found');

    }

    public function showAll(){
        if(request()->ajax()){
            $tienda = request('tienda');
            $ordenes = Orden::where('tienda_id', $tienda)->get();
            $html = '';
            foreach($ordenes as $orden){
                $html .= '<tr>';
                $html .= '<td>'.$orden->id.'</td>';
                $html .= '<td>'.$orden->nombre.'</td>';
                $html .= '<td style="color:'.($orden->direccion ? "orange" : "green").'; font-weight:bold">'. ($orden->direccion ? "DESPACHO A DOMICILIO" : "RETIRO EN TIENDA").'</td>';
                $html .= '<td>'.$orden->tipo_pago.'</td>';
                $html .= '<td>'.$orden->estado.'</td>';
                $html .= '<td><a href="'.url("admin/orden", $orden->id).'">Ver detalles</a></td>';
            }

            return $html;
        }
    }
}
