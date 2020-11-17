@extends('frontend.templates.principal')

@section('content')
    <section id="cart_items" style="margin-bottom: 200px">
        <div class="container">
            <h1 class="titulo-principal">Carrito de compras</h1>
            <hr>

            <div class="row">

                <div class="col-md-8">
                    <h2 class="title text-center">Productos en carrito</h2>

                    @if(Session::has($cartname))
                            <div class="cart-item-container">
                                <div class="loading-item-cart" style="display: none">
                                    <div class="loading-cart"></div>
                                </div>

                                @foreach($cart_productos as $producto)
                                <div class="cart-item">
                                    <div class="img-container">
                                        <div title="Eliminar" data-toggle="tooltip" data-placement="bottom" class="btn-submit-reset-on-cart btn-cart-item-xs d-none" data-id="{{$producto['item']['id']}}"><i class="fa fa-trash"></i></div>
                                        <img src="{{asset('images/uploads/productos').'/'.$producto['item']['img']}}" alt="">
                                    </div>
                                    <div class="text-container">
                                        <div class="title">{{$producto['item']['nombre']}}</div>
                                        <div class="text">{{$producto['item']['descripcion']}}</div>
                                    </div>
                                    <div class="controls">
                                        <select class="form-control select-qty-item-cart" name="" id="" data-id="{{$producto['item']['id']}}">
                                            @for($i = 0; $i < 10; $i++)
                                            <option value="{{$i}}" {{$i == $producto['cantidad'] ? 'selected' : ''}}>{{$i}}</option>
                                                @endfor
                                        </select>
                                    </div>
                                    <div class="precio">
                                        $ {{number_format($producto['item']['precio'], 0, '', '.')}}
                                    </div>
                                    <div title="Eliminar" data-toggle="tooltip" data-placement="bottom" class="btn-submit-reset-on-cart btn-cart-item" data-id="{{$producto['item']['id']}}"><i class="fa fa-trash"></i></div>
                                </div>
                                @endforeach
                            </div>

                        <a href="{{url('/productos')}}">
                        <button class="btn-seguir-comprando">
                            <i class="fa fa-angle-double-left"></i>
                            Seguir comprando
                        </button>
                        </a>
                </div>

                <div class="col-md-4" style="position: relative">
                    <div class="loading-aside-cart">
                        <div class="loading-cart"></div>
                    </div>
                    <div class="card" style="margin-top: 20px">
                        <div class="card-body">
                            <strong style="font-size: 20px;">RESUMEN DE SU COMPRA</strong>
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

                            <div id="panel-envio" class="panel panel-default {{Session::has($envioname) ? '':' d-none'}}">
                                 <div class="panel-heading">
                                      <i class="fa fa-shipping-fast"></i>
                                      Coste de envio
                                 </div>
                                 <div class="panel-body text-center">

                                         @if(Session::has($envioname) && Session::get($envioname)->precio == 0)
                                             <div id="precio-envio" style="font-size: 18px;font-weight: bold">
                                                 <i style="color: green">GRATIS</i>
                                             </div>
                                         @else
                                             <div id="precio-envio" style="font-size: 18px;font-weight: bold">$ {{Session::has($envioname) ? number_format(Session::get($envioname)->precio,0,'','.') : 0}}</div>
                                         @endif
                                         <div id="descripcion-envio">{{Session::has($envioname) ? Session::get($envioname)->descripcion : ''}}</div>
                                 </div>
                            </div>

                            <div id="panel-sin-envio" class="panel panel-default {{Session::has($envioname) ? ' d-none':''}}">
                                <div class="panel-heading">

                                    No hay envio disponible
                                </div>
                                <div class="panel-body text-center">
                                    <div id="precio-envio" style="color:var(--color-primary);font-weight: bolder">
                                        <i class="fa fa-store-alt"></i>
                                        Retiro en tienda</div>
                                </div>
                            </div>


                            <hr style="border-color: #d5d5d5">
                            <div class="panel panel-default text-center">
                                <div class="panel-heading" style="font-size: 17px;font-weight: bold">TOTAL</div>
                                <div class="panel-body " style="font-size: 22px;color:var(--color-primary)">
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
                        <div class="col-xs-12">
                            <div class="no-cart">
                                <div class="icon-container">
                                    <div class="icon"></div>
                                    <i class="fa fa-cart-arrow-down"></i>
                                </div>
                                <div class="text-container">
                                    <div class="title">
                                        No hay productos en el carro
                                    </div>
                                    <div class="text">
                                        Puedes agregar productos al carrito visitando nuestra zona de productos
                                    </div>
                                    <a href="{{url('/productos')}}" class="btn-no-cart">Ir a Productos</a>
                                </div>
                            </div>
                        </div>
                    <!--div class="alert alert-info" style="margin-bottom: 300px">
                        <h5> <i class="fas fa-cart-arrow-down"></i>
                            No hay Items en el Carrito
                        </h5>
                    </div-->
                @endif
            </div><!--/.row-->

        </div>


    </section> <!--/#cart_items-->

    <div class="container-fluid banner-inferior-container">
        <div class="banner-inferior">
            <div class="img-container">
                <img src="{{asset('images/system/navbar-new2.png')}}" alt="">
            </div>
            <div class="text-container">
                <div class="title">
                    Comercio Central
                </div>
                <div class="text">
                    El centro del comercio electronico, donde puedes vender tus productos
                    en una elegante tienda virtual
                </div>
                <button class="btn-banner">Crea tu tienda ahora</button>
            </div>
        </div>
    </div>
@endsection
