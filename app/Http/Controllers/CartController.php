<?php

namespace App\Http\Controllers;


use App\Cart;
use App\Envio;
use App\FooterInfo;
use App\HeaderFrontend;
use App\Loader;
use App\Producto;
use App\SiteSocial;
use App\TeamMember;
use Illuminate\Http\Request;
use Session;
use Transbank\Webpay\Configuration;
use Transbank\Webpay\Webpay;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    private $data;

    public function __construct(){
        /*$loader = new Loader();
        $this->data =  $loader->getData();*/
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $domain = request()->route('domain');
        //dd($domain);
        if($domain) {
            $loader = new Loader($domain);
            //dd($loader->checkDominio());
            if ($loader->checkDominio()) {
                $loader->checkDominioAdmin();
                $data = $loader->getData();
                $cartName = $data['cartname'];
                $envioName = $data['envioname'];
                if(!Session::has($cartName)){

                    $data['cart_productos'] = null;
                    $data['precio_total'] = 0;
                    $data['envios'] = Envio::where('tienda_id', $data['tienda']->id);

                    return view('frontend.cart', $data);
                }

                $oldCart = Session::get($cartName);
                $cart = new Cart($oldCart);

                $this->calcularEnvio($cart->precioTotal, $data['tienda']->id);
                $total_mas_envio = Session::has($envioName) ? $cart->precioTotal + Session::get($envioName)->precio : $cart->precioTotal;

                $data['cart'] = $cart;
                $data['cart_productos'] = $cart->items;
                $data['precio_total'] = $cart->precioTotal;
                $data['total_mas_envio'] = $total_mas_envio;
                $data['envio'] = Session::has($envioName) ? Session::get($envioName) : null;

                return view('frontend.cart', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

    public function isMax($envios){
        $envioReturn = null;
        foreach($envios->get() as $envio){
            if($envio->max_price == 0){
                $envioReturn = $envio;
            }
        }
        return $envioReturn;
    }

    public function calcularEnvio($precioTotal, $tienda){
        $envioName = 'envio-' . $tienda;
        //FUNCION que calcula si el total tiene envio y lo almacena en session
        $enviosMinPrice = Envio::where('min_price', '<=', $precioTotal)->where('tienda_id', $tienda);
        $envioMax = $this->isMax($enviosMinPrice);
        if($envioMax){
            Session::put($envioName, $envioMax);
        }else{
            $envio = Envio::where('min_price', '<=', $precioTotal)
                ->where('max_price', '>=', $precioTotal)->where('tienda_id', $tienda);
            if($envio->first()){
                Session::put($envioName, $envio->first());
            }else{
                Session::forget($envioName);
            }
        }
    }



    public function addItemsToCart(Request $request){
        $producto = Producto::find($request->get('id'));
        $tienda = $request->get('tienda');
        //dd($tienda);
        $cartName = 'cart-'. $tienda;
        $oldCart = Session::has($cartName) ? Session::get($cartName) : null;
        $cart = new Cart($oldCart);
        $cart->add($producto, $producto->id);

        $request->session()->put($cartName, $cart);
        $this->calcularEnvio($cart->precioTotal, $tienda);
        return response()->json([
            'status'=>'ok',
            'cantidad_total' => $cart->cantidadTotal,
            'id_producto' => $request->get('id'),
            'cantidad_producto' => $cart->items[$request->get('id')]['cantidad']]);
    }

    public function removeItemOnCart(Request $request, $domain, $id, $tienda){
        $cartName = 'cart-' . $tienda;
        $oldCart = Session::has($cartName) ? Session::get($cartName) : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items) > 0){
            Session::put($cartName, $cart);
        }else{
            Session::forget($cartName);
        }
        $cantidadProducto = 0;

        if(isset($cart->items[$id]) && $cart->items[$id] != null){
            $cantidadProducto = $cart->items[$id]['cantidad'];
        }
        $this->calcularEnvio($cart->precioTotal, $tienda);
        return response()->json([
            'status'=>'ok',
            'cantidad_total' => $cart->cantidadTotal,
            'id_producto' => $id,
            'cantidad_producto' => $cantidadProducto]);
    }

    public function resetItemOnCart(Request $request, $domain, $id, $tienda){
        $cartName = 'cart-' . $tienda;
        $envioName = 'envio-' . $tienda;
        $oldCart = Session::has($cartName) ? Session::get($cartName) : null;
        $cart = new Cart($oldCart);

        $cart->resetItem($id);

        if(count($cart->items) > 0){
            Session::put($cartName, $cart);
        }else{
            Session::forget($cartName);
        }

        $this->calcularEnvio($cart->precioTotal, $tienda);
        $total_mas_envio = Session::has($envioName) ? $cart->precioTotal + Session::get($envioName)->precio : $cart->precioTotal;

        $data = [
            'cart' => $cart,
            'cart_productos' => $cart->items,
            'precio_total' => $cart->precioTotal,
            'total_mas_envio' => $total_mas_envio,
            'envio' => Session::has($envioName) ? Session::get($envioName) : null,
        ];

        return response()->json([
            'html' => view('frontend.templates.cart-ajax', $data)->render(),
            'cantidad_total' => $cart->cantidadTotal//Retorna respuesta al badge carrito
        ]);
    }

    public function processItemByQty(Request $request){
        $tienda = $request->get('tienda');
        $cartName = 'cart-' . $tienda;
        $envioName = 'envio-' . $tienda;
        $cantidad = $request->get('cantidad');
        $id = $request->get('id');
        $producto = Producto::find($id);

        $oldCart = Session::has($cartName) ? Session::get($cartName) : null;
        $cart = new Cart($oldCart);

        $cart->addByQty($producto, $producto->id, $cantidad);

        if(count($cart->items) > 0){
            Session::put($cartName, $cart);
        }else{
            Session::forget($cartName);
        }
        $cantidadProducto = 0;
        if(isset($cart->items[$id]) && $cart->items[$id] != null){
            $cantidadProducto = $cart->items[$id]['cantidad'];
        }

        $this->calcularEnvio($cart->precioTotal, $tienda);
        $total_mas_envio = Session::has($envioName) ? $cart->precioTotal + Session::get($envioName)->precio : $cart->precioTotal;

        return response()->json([
            'cantidad_total' => $cart->cantidadTotal,
            'id_producto' => $id,
            'cantidad_producto' => $cantidadProducto,
            'total_producto' => number_format($cart->items[$id]['precio'], 0, '', '.'),
            'precio_total' => number_format($cart->precioTotal, 0, '','.'),
            'total_mas_envio' => number_format($total_mas_envio, 0, '', '.'),
            'envio' => Session::has($envioName),
            'descripcion_envio' => Session::has($envioName) ? Session::get($envioName)->descripcion : '',
            'precio_envio' => Session::has($envioName) ? number_format(Session::get($envioName)->precio, 0, '', '.') : 0
            ]);
    }
}
