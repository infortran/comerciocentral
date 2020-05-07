@extends('frontend.templates.principal')

@section('content')
    <section id="cart_items" style="margin-bottom: 200px">
        <div class="container">
            <h1 class="titulo-principal">Carrito de compras</h1>
            <hr>

            <div class="row">

                <div class="col-md-9">
                    <h2 class="title text-center">Productos en carrito</h2>
                    @if(Session::has('cart'))


                           <table class="table table-striped" style="position: relative">
                               <div class="loading-item-cart" style="display: none">
                                   <div class="loading-cart"></div>
                               </div>

                               <thead>
                                   <tr>
                                       <th colspan="2">Caracteristicas</th>
                                       <th class="hidden-xs">Precio</th>
                                       <th>Cantidad</th>
                                       <th class="hidden-xs">Total</th>
                                   </tr>

                               </thead>
                               <tbody>
                               @foreach($cart_productos as $producto)
                                    <tr>
                                        <td><img style="max-height: 100px" src="{{asset('images/uploads/productos').'/'.$producto['item']['img']}}" alt=""></td>
                                        <td width="25%">
                                            <div>{{$producto['item']['nombre']}}</div>
                                            <div style="font-size: 20px" class="visible-sm visible-xs">
                                                <strong>{{$producto['cantidad']}}</strong> x
                                                $ {{number_format($producto['item']['precio'], 0, '', '.')}}
                                            </div>
                                        </td>
                                        <td class="hidden-xs">$ {{number_format($producto['item']['precio'], 0, '', '.')}}</td>
                                        <td width="30%">
                                            <button class="btn btn-plus-minus-cart btn-minus-cart" style="margin-right: 5px" data-id="{{$producto['item']['id']}}">
                                                <i class="fa fa-minus"></i>
                                            </button>

                                            <input style="max-width: 45px;display: inline-block;float:left !important"
                                                   class="input-item-cart form-control text-center input-number-to-text"
                                                   type="number" min="0" data-id="{{$producto['item']['id']}}"
                                                   id="input-item-cart-{{$producto['item']['id']}}"
                                                   value="{{$producto['cantidad']}}" autocomplete="off">

                                            <button class="btn btn-plus-minus-cart btn-plus-cart"  style="margin-left: 5px" data-id="{{$producto['item']['id']}}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                        <td class="hidden-xs" style="font-size: 18px">
                                            <strong id="total-producto-{{$producto['item']['id']}}">$ {{number_format($producto['precio'], 0, '', '.')}}</strong>
                                        </td>
                                        <td>
                                            <i onclick="resetOnCartFromAjax({{$producto['item']['id']}})" class="reset-item-cart fa fa-window-close fa-2x" style="color: red;cursor:pointer"></i>
                                        </td>
                                    </tr>
                               @endforeach
                               </tbody>
                           </table>
                        <a href="{{url('/productos')}}">
                        <button class="btn-seguir-comprando">
                            <i class="fa fa-angle-double-left"></i>
                            Seguir comprando
                        </button>
                        </a>
                </div>

                <div class="col-md-3" style="position: relative">
                    <div class="loading-aside-cart">
                        <div class="loading-cart"></div>
                    </div>
                    <div class="card" style="margin-top: 20px">
                        <div class="card-body">
                            <strong>RESUMEN DE SU COMPRA</strong>
                            <hr style="border-color: #d5d5d5">
                            <table class="table borderless">
                                <tr>
                                    <td>Total de productos:</td>
                                    <td class="text-center " id="cart-cantidad-total"><strong>{{$cart->cantidadTotal}}</strong></td>
                                </tr>
                                <tr>
                                    <td>Subtotal:</td>
                                    <td id="cart-subtotal"><strong>$ {{number_format($precio_total, 0, '','.')}}</strong></td>
                                </tr>
                            </table>

                            <div id="panel-envio" class="panel panel-default {{$envio ? '':' d-none'}}">
                                 <div class="panel-heading">
                                      <i class="fa fa-shipping-fast"></i>
                                      Coste de envio
                                 </div>
                                 <div class="panel-body text-center">
                                      @if(isset($envio->precio) && $envio->precio == 0)
                                           <div id="precio-envio" style="font-size: 18px;font-weight: bold">Envio Sin Costo</div>
                                      @else
                                           <div id="precio-envio" style="font-size: 18px;font-weight: bold">$ {{$envio->precio ?? ''}}</div>
                                      @endif
                                            <div id="descripcion-envio">{{$envio->descripcion ?? ''}}</div>
                                 </div>
                            </div>

                            <div id="panel-sin-envio" class="panel panel-default {{$envio ? ' d-none':''}}">
                                <div class="panel-heading">
                                    <i class="fa fa-store-alt"></i>
                                    Retiro en tienda
                                </div>
                                <div class="panel-body text-center">
                                    <div id="precio-envio">

                                        No hay envio disponible</div>
                                </div>
                            </div>


                            <hr style="border-color: #d5d5d5">
                            <div class="panel panel-default text-center">
                                <div class="panel-heading" style="font-size: 17px">TOTAL</div>
                                <div class="panel-body " style="font-size: 22px">
                                    <strong id="total-mas-envio">$ {{number_format($total_mas_envio, 0, '', '.')}}</strong>
                                </div>
                            </div>
                            <a href="{{url('/checkout')}}">
                            <div class="btn-checkout btn-block text-center">
                                Comprar
                                <div></div>
                                <i class="fa fa-money-bill-wave"></i>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
                @else
                    <div class="alert alert-info" style="margin-bottom: 300px">
                        <h5> <i class="fas fa-cart-arrow-down"></i>
                            No hay Items en el Carrito
                        </h5>
                    </div>
                @endif
            </div><!--/.row-->

        </div>


    </section> <!--/#cart_items-->
@endsection
