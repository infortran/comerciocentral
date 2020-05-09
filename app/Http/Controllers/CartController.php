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
        $loader = new Loader();
        $this->data =  $loader->getData();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Session::has('cart')){

            $this->data['cart_productos'] = null;
            $this->data['precio_total'] = 0;
            $this->data['envios'] = Envio::all();

            return view('frontend.cart', $this->data);
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $this->calcularEnvio($cart->precioTotal);
        $total_mas_envio = Session::has('envio') ? $cart->precioTotal + Session::get('envio')->precio : $cart->precioTotal;

        $this->data['cart'] = $cart;
        $this->data['cart_productos'] = $cart->items;
        $this->data['precio_total'] = $cart->precioTotal;
        $this->data['total_mas_envio'] = $total_mas_envio;
        $this->data['envio'] = Session::has('envio') ? Session::get('envio') : null;

        return view('frontend.cart', $this->data);
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

    public function calcularEnvio($precioTotal){
        //FUNCION que calcula si el total tiene envio y lo almacena en session
        $enviosMinPrice = Envio::where('min_price', '<=', $precioTotal);
        $envioMax = $this->isMax($enviosMinPrice);
        if($envioMax){
            Session::put('envio', $envioMax);
        }else{
            $envio = Envio::where('min_price', '<=', $precioTotal)
                ->where('max_price', '>=', $precioTotal);
            if($envio->first()){
                Session::put('envio', $envio->first());
            }else{
                Session::forget('envio');
            }
        }
    }



    public function addItemsToCart(Request $request){

        $producto = Producto::find($request->get('id'));
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($producto, $producto->id);

        $request->session()->put('cart', $cart);
        $this->calcularEnvio($cart->precioTotal);
        return response()->json([
            'status'=>'ok',
            'cantidad_total' => $cart->cantidadTotal,
            'id_producto' => $request->get('id'),
            'cantidad_producto' => $cart->items[$request->get('id')]['cantidad']]);
    }

    public function removeItemOnCart(Request $request, $id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
        }
        $cantidadProducto = 0;

        if(isset($cart->items[$id]) && $cart->items[$id] != null){
            $cantidadProducto = $cart->items[$id]['cantidad'];
        }
        $this->calcularEnvio($cart->precioTotal);
        return response()->json([
            'status'=>'ok',
            'cantidad_total' => $cart->cantidadTotal,
            'id_producto' => $id,
            'cantidad_producto' => $cantidadProducto]);
    }

    public function resetItemOnCart(Request $request, $id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->resetItem($id);

        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
        }

        $this->calcularEnvio($cart->precioTotal);
        $total_mas_envio = Session::has('envio') ? $cart->precioTotal + Session::get('envio')->precio : $cart->precioTotal;

        $data = [
            'cart' => $cart,
            'cart_productos' => $cart->items,
            'precio_total' => $cart->precioTotal,
            'total_mas_envio' => $total_mas_envio,
            'envio' => Session::has('envio') ? Session::get('envio') : null,
        ];

        return response()->json([
            'html' => view('frontend.templates.cart-ajax', $data)->render(),
            'cantidad_total' => $cart->cantidadTotal//Retorna respuesta al badge carrito
        ]);
    }

    public function processItemByQty(Request $request){
        $cantidad = $request->get('cantidad');
        $id = $request->get('id');
        $producto = Producto::find($id);

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->addByQty($producto, $producto->id, $cantidad);

        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
        }
        $cantidadProducto = 0;
        if(isset($cart->items[$id]) && $cart->items[$id] != null){
            $cantidadProducto = $cart->items[$id]['cantidad'];
        }

        $this->calcularEnvio($cart->precioTotal);
        $total_mas_envio = Session::has('envio') ? $cart->precioTotal + Session::get('envio')->precio : $cart->precioTotal;

        return response()->json([
            'cantidad_total' => $cart->cantidadTotal,
            'id_producto' => $id,
            'cantidad_producto' => $cantidadProducto,
            'total_producto' => number_format($cart->items[$id]['precio'], 0, '', '.'),
            'precio_total' => number_format($cart->precioTotal, 0, '','.'),
            'total_mas_envio' => number_format($total_mas_envio, 0, '', '.'),
            'envio' => Session::has('envio'),
            'descripcion_envio' => Session::has('envio') ? Session::get('envio')->descripcion : '',
            'precio_envio' => Session::has('envio') ? number_format(Session::get('envio')->precio, 0, '', '.') : 0
            ]);
    }
}
