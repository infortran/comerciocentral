@extends('frontend.templates.principal')

@section('content')
    <section id="cart_items" style="margin-bottom: 200px">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h2 class="title text-center">Carrito de compras</h2>
                    @if(Session::has('cart'))
                       <?php /* <div class="table-responsive cart_info">
                            <table class="table table-striped">
                                <thead>
                                <tr class="cart_menu">
                                    <td class="image">Detalles del producto</td>
                                    <td class="description"></td>
                                    <td class="price">Precio</td>
                                    <td class="quantity">Cantidad</td>
                                    <td class="total">Total</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart_productos as $producto)
                                        <tr >
                                            <td class="cart_product">
                                                <a href=""><img style="max-height: 70px" src="{{asset('images/uploads/productos').'/'.$producto['item']['img']}}" alt=""></a>
                                            </td>
                                            <td class="cart_description">
                                                <h4>{{$producto['item']['nombre']}}</h4>

                                            </td>
                                            <td class="cart_price">
                                                <p>${{$producto['precio']}}</p>
                                            </td>
                                            <td class="cart_quantity">
                                                <div class="cart_quantity_button">

                                                    <input style="max-width: 70px" class="form-control" type="number" name="quantity" value="{{$producto['cantidad']}}" autocomplete="off">

                                                </div>
                                            </td>
                                            <td class="cart_total">
                                                <p class="cart_total_price"></p>
                                            </td>
                                            <td class="cart_delete">
                                                <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                                            </td>

                                        </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div> */ ?>

                        <hr>
                        <div class="row ">
                            <div class="col-sm-5">
                                <strong class="uppercase">Caracteristicas del producto</strong>
                            </div>
                            <div class="col-sm-2">
                                <strong class="uppercase">Cantidad</strong>
                            </div>
                            <div class="col-sm-2">
                                <strong class="uppercase">Precio</strong>
                            </div>
                            <div class="col-sm-2">
                                <strong class="uppercase">Total</strong>
                            </div>
                        </div>
                        <hr>
                       @foreach($cart_productos as $producto)
                        <div style="min-height: 100px; margin-top: 10px" class="row card card-cart center-vertical">
                            <div class="col-sm-2">
                                <img style="max-height: 70px" class="img-responsive" src="{{asset('images/uploads/productos').'/'.$producto['item']['img']}}" alt="">
                            </div>
                            <div class="col-sm-3">
                                {{$producto['item']['nombre']}}
                            </div>
                            <div class="col-sm-2">
                                <input style="max-width: 70px" class="form-control" type="number" value="{{$producto['cantidad']}}" autocomplete="off">
                            </div>
                            <div class="col-sm-2" >
                                $ {{number_format($producto['item']['precio'], 0, '', '.')}}
                            </div>
                            <div class="col-sm-2" style="padding-left: 25px">
                                <strong>$ {{number_format($producto['precio'], 0, '', '.')}}</strong>
                            </div>
                            <div class="col-sm-1">
                                <i class="fa fa-window-close fa-lg"></i>
                            </div>
                        </div>
                        @endforeach

                </div>

                <div class="col-md-3">
                    <div class="card" style="margin-top: 20px">
                        <div class="card-body">
                            <strong>RESUMEN DE SU COMPRA</strong>
                            <hr style="border-color: #afafaf">
                            <table class="table borderless">
                                <tr>
                                    <td>Total de productos:</td>
                                    <td class="text-center">{{sizeof($cart_productos)}}</td>
                                </tr>
                                <tr>
                                    <td>Subtotal:</td>
                                    <td>${{number_format($precio_total, 0, '','.')}}</td>
                                </tr>
                            </table>
                            <select class="form-control">
                                <option value="0">Envio $500</option>
                            </select>
                            <hr style="border-color: #afafaf">
                            <table class="table borderless">
                                <tr>
                                    <td><h4>Total:</h4></td>
                                    <td><h4>0</h4></td>
                                </tr>
                            </table>
                            <div class="btn-checkout btn-block text-center">
                                Comprar
                                <div></div>
                                <i class="fa fa-money-bill-wave"></i>
                            </div>

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
