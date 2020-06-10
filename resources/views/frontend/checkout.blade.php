@extends('frontend.templates.principal')

@section('content')

    <section>
        <form class="container" action="{{url('/payment')}}" method="POST">
            @csrf
            <h1 class="titulo-principal">
                Revisa y confirma tu orden
            </h1>
            <hr>


            <div class="row">
                @if(Session::has('envio'))
                <div class="col-md-6">
                    @if(Auth::check())
                        <div class="panel panel-default"   style="background: #fafafa">
                            <div class="panel-heading">
                                <h4>
                                    <div class="icon-titulo">
                                        <i class="fa fa-shipping-fast"></i>
                                    </div>

                                    Detalle del envio</h4>
                            </div>
                            <div class="panel-body">
                                <h4>Tus datos personales</h4>
                                <hr>

                                <div class="list-group">
                                    <div class="list-group-item list-group-item-checkout" style="padding:20px">
                                        <div>
                                            <img class="img-rounded" style="max-height: 50px" src="{{asset('images/uploads/users') .'/'. Auth::user()->img}}" alt="">
                                        </div>
                                        <div>
                                            <h4>{{Auth::user()->name}} {{Auth::user()->lastname}}</h4>
                                        </div>
                                        <div>
                                            <p>
                                                <i class="fa fa-phone"></i>
                                                {{Auth::user()->telefono}}
                                            </p>
                                            <p>
                                                <i class="fa fa-envelope"></i>
                                                {{Auth::user()->email}}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <h4>Direccion de envio</h4>
                                <hr>
                                <div class="list-group">
                                    @foreach(Auth::user()->direccions as $key => $direccion)
                                    <div class="list-group-item list-group-item-checkout">
                                        <div>
                                            <input type="radio" value="{{$direccion->id}}" name="direccion_envio" {{$key == 0?'checked':''}}>
                                        </div>
                                        <div>
                                            <h4>
                                                <div class="icon-titulo" style="background: #f5f5f5">
                                                    <i class="fa fa-map-marker-alt" style="padding: 5px"></i>
                                                </div>
                                            </h4>
                                        </div>
                                        <div>
                                            <h4>{{$direccion->calle}} #{{$direccion->numero}}  {{$direccion->departamento ? '/ Depto.' . $direccion->departamento : ''}}</h4>
                                            <p>{{$direccion->poblacion}} - {{$direccion->ciudad}}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>



                            </div>
                        </div>
                    @else
                        <div class="panel panel-default"   style="background: #fafafa">
                            <div class="panel-heading">
                                <h4>
                                    <div class="icon-titulo">
                                        <i class="fa fa-shipping-fast"></i>
                                    </div>

                                    Detalle del envio</h4>
                            </div>
                            <div class="panel-body">
                                <h4>Tus datos personales</h4>
                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Tu nombre <i style="color: red">*</i></label>
                                            <input name="nombre" type="text" class="form-control" placeholder="Nombre y apellido" autocomplete="off">
                                            @error('nombre')
                                            <p style="color: red">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email <i style="color: red">*</i></label>
                                            <input name="email" type="email" class="form-control" placeholder="ej. usuario@dominio.com">
                                            @error('email')
                                            <p style="color: red">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Telefono <i style="color: red">*</i></label>
                                            <input name="telefono" type="text" class="form-control" placeholder="ej. +56 9 12345678">
                                            @error('telefono')
                                            <p style="color: red">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <hr>
                                <h4>Direccion de envio</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">Calle <i style="color: red">*</i></label>
                                            <input name="calle" type="text" class="form-control" placeholder="ej. Av. Maipu">
                                            @error('calle')
                                            <p style="color: red">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Numero <i style="color: red">*</i></label>
                                            <input name="numero" type="text" class="form-control" placeholder="ej. 123">
                                            @error('numero')
                                            <p style="color: red">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="">Villa / Poblacion <i style="color: red">*</i></label>
                                            <input name="poblacion" type="text" class="form-control" placeholder="Ingrese su Villa / Poblacion">
                                            @error('poblacion')
                                            <p style="color: red">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Num. Depto.</label>
                                            <input name="departamento" type="text" class="form-control" placeholder="Opcional">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 50px">
                                    <div class="col-md-12">
                                        <label for="">Ciudad <i style="color: red">*</i></label>
                                        <select name="ciudad" class="form-control" id="">
                                            <option value="San Felipe" selected>San Felipe</option>
                                        </select>
                                        @error('ciudad')
                                        <p style="color: red">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif

                </div>
                @else
                     <div class="col-md-6">
                         <div class="list-group">
                             <div class="list-group-item text-center" style="background: #efefef">
                                 <h4 style="font-size: 80px">
                                     <div class="icon-titulo" >
                                         <i class="fa fa-store"></i>
                                     </div>
                                 </h4>
                                 <h4>RETIRO EN TIENDA</h4>
                                 <p>Puedes pasar a retirar en tienda presentando el numero de orden</p>
                                 <small>El numero de orden te sera entregado una vez hayas pagado</small>
                             </div>
                            @if(Auth::check())
                                 <div class="panel panel-default"   style="background: #fafafa">

                                     <div class="panel-body">
                                         <h4>Tus datos personales</h4>
                                         <hr>

                                         <div class="list-group">
                                             <div class="list-group-item list-group-item-checkout" style="padding:20px">
                                                 <div>
                                                     <img class="img-rounded" style="max-height: 50px" src="{{asset('images/uploads/users') .'/'. Auth::user()->img}}" alt="">
                                                 </div>
                                                 <div>
                                                     <h4>{{Auth::user()->name}} {{Auth::user()->lastname}}</h4>
                                                 </div>
                                                 <div>
                                                     <p>
                                                         <i class="fa fa-phone"></i>
                                                         {{Auth::user()->telefono}}
                                                     </p>
                                                     <p>
                                                         <i class="fa fa-envelope"></i>
                                                         {{Auth::user()->email}}
                                                     </p>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             @else
                                 <div class="list-group-item"   style="background: #fafafa">
                                     <h4>Tus datos personales</h4>
                                     <hr>

                                     <div class="row">
                                         <div class="col-md-12">
                                             <div class="form-group">
                                                 <label for="">Tu nombre <i style="color: red">*</i></label>
                                                 <input name="nombre" type="text" class="form-control" placeholder="Nombre y apellido" required autocomplete="off">
                                                 @error('nombre')
                                                 <p style="color: red">{{$message}}</p>
                                                 @enderror
                                             </div>
                                         </div>
                                     </div>

                                     <div class="row">
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                 <label for="">Email <i style="color: red">*</i></label>
                                                 <input name="email" type="email" class="form-control" placeholder="ej. usuario@dominio.com">
                                                 @error('email')
                                                 <p style="color: red">{{$message}}</p>
                                                 @enderror
                                             </div>
                                         </div>
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                 <label for="">Telefono <i style="color: red">*</i></label>
                                                 <input name="telefono" type="text" class="form-control" placeholder="ej. +56 9 12345678">
                                                 @error('telefono')
                                                 <p style="color: red">{{$message}}</p>
                                                 @enderror
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             @endif
                         </div>
                     </div>

                @endif
                <div class="col-md-6">
                    <div class="panel panel-default"  style="background: #fafafa">
                        <div class="panel-heading">
                            <h4>
                                <div class="icon-titulo">
                                    <i class="fa fa-money-check-alt"></i>
                                </div>

                                Detalle del pago
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="list-group">
                                        @foreach($cart->items as $producto)
                                        <div class="list-group-item  list-group-item-checkout">

                                                <div style="width: 40%">
                                                    <strong>{{$producto['item']['nombre']}}</strong>

                                                </div>
                                                <div>
                                                    {{$producto['cantidad']}}
                                                    <span style="color: #ff6300;font-size: 18px">
                                                       x
                                                    </span>
                                                    $ {{number_format($producto['item']['precio'], 0,'','.')}}
                                                </div>
                                                <div class="td-checkout">
                                                    <strong>$ {{number_format($producto['precio'],0,'','.')}}</strong>
                                                </div>

                                        </div>
                                        @endforeach


                                        <div class="list-group-item  list-group-item-checkout">

                                            <div>
                                                SUBTOTAL
                                            </div>
                                            <div class="td-checkout">
                                                <?php $subtotal = $cart ? $cart->precioTotal : 0 ?>
                                                <strong>$ {{ number_format($subtotal, 0, '', '.') }}</strong>
                                            </div>

                                        </div>

                                        <div class="list-group-item  list-group-item-checkout">

                                            <div>
                                                COSTE DE ENVIO
                                            </div>
                                            <div class="td-checkout">
                                                @if(Session::has('envio'))
                                                    @if(Session::get('envio')->precio > 0)
                                                        <strong>$ {{number_format(Session::get('envio')->precio, 0, '', '.')}}</strong>
                                                    @else
                                                        <strong style="color: green">GRATIS</strong>
                                                    @endif
                                                @else
                                                    <strong style="color: red">ENVIO NO DISPONIBLE</strong>
                                                @endif
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="list-group">
                                        <div class="list-group-item list-group-item-checkout">
                                            <div>
                                                <input type="radio" value="webpay" name="forma_pago" checked>
                                            </div>
                                            <div>
                                                <img style="max-height: 80px" src="{{asset('images/system/webpay.jpg')}}" alt="">
                                            </div>
                                            <div>
                                                <strong>Pago con Webpay</strong>
                                            </div>
                                        </div>

                                        <div class="list-group-item list-group-item-checkout">
                                            <div>
                                                <input type="radio" value="deposito"  name="forma_pago">
                                            </div>
                                            <div class="text-center">
                                                <div class="icon-titulo-inverse" style="font-size: 30px">
                                                    <i class="fa fa-university"></i>
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <strong>Deposito Bancario (sujeto a confirmación)</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="list-group text-center">
                                        <div class="list-group-item" style="font-size: 17px"><strong>TOTAL</strong></div>
                                        <div class="list-group-item" style="font-size:30px;color: #0ba360;font-weight: bold">
                                            $ {{number_format($total_final, 0, '', '.')}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-center" >
                                    <input type="hidden" name="token_ws" value="">
                                    <button type="submit" class="btn-hover color-1">

                                        CONFIRMAR Y COMPRAR
                                    </button>
                                </div>
                            </div>



                        </div>
                    </div>

                </div>
            </div>
        </form>
    </section>


@endsection
