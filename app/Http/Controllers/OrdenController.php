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
            if ($loader->checkDominioAdmin()) {
                $data = $loader->getData();
                if($request){
                    $ordenes = $data['tienda']->ordenes()->whereDate('created_at', Carbon::today());
                    $countOrdenes = $ordenes->count();
                    $data['totales'] = $this->getTotalDia($ordenes);
                    $data['search'] = null;
                    $data['ordenes'] = $ordenes->paginate(4);
                    $data['count_ordenes'] = $countOrdenes;
                    Carbon::setLocale('es');
                    Carbon::setUTF8(true);
                    setlocale(LC_ALL, 'es_MX', 'es', 'ES');
                    $tiempo = Carbon::today();
                    //dd($tiempo);
                    $data['hoy'] = $tiempo->formatLocalized('%A %d de %B de %Y');
                    //dd($data['hoy']);
                }
                $query = trim($request->get('search'));
                if($query){
                    $ordenes = $data['tienda']->ordenes()->where('number', $query)->orderBy('number', 'desc')->paginate(4);
                    $data['search'] = $query;
                    $data['ordenes'] = $ordenes;
                }
                return view('backend.ordenes.index', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

    public function getTotalDia($ordenes){
        $totales = [
            'envios_dia' => 0,
            'ventas_dia' => 0
        ];
        foreach ($ordenes->get() as $orden){
            $totales['ventas_dia'] += $orden->total;
            $totales['envios_dia'] += $orden->envio;
        }
        $totales['total_dia'] = $totales['ventas_dia'] + $totales['envios_dia'];
        return $totales;
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
