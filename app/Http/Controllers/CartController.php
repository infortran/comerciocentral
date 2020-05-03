<?php

namespace App\Http\Controllers;

use App\Cart;
use App\FooterInfo;
use App\HeaderFrontend;
use App\Producto;
use App\SiteSocial;
use App\TeamMember;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Session::has('cart')){
            $data = [
                'header' => HeaderFrontend::find(1),
                'footer' => FooterInfo::find(1),
                'members' => TeamMember::all(),
                'siteSocials' => SiteSocial::all(),
                'cart_productos' => null,
                'precio_total' => 0
            ];

            return view('frontend.cart', $data);
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $data = [
            'header' => HeaderFrontend::find(1),
            'footer' => FooterInfo::find(1),
            'members' => TeamMember::all(),
            'siteSocials' => SiteSocial::all(),
            'cart_productos' => $cart->items,
            'precio_total' => $cart->precioTotal
        ];
        return view('frontend.cart', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function addItemsToCart(Request $request){

        $producto = Producto::find($request->get('id'));
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($producto, $producto->id);

        $request->session()->put('cart', $cart);
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
        $cantidadProducto = 0;

        if($cart->items[$id] != null){
            $cantidadProducto = $cart->items[$id]['cantidad'];
        }
        Session::put('cart', $cart);
        return response()->json([
            'status'=>'ok',
            'cantidad_total' => $cart->cantidadTotal,
            'id_producto' => $id,
            'cantidad_producto' => $cantidadProducto]);
    }
}
