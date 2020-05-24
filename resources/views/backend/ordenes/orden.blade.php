@extends('backend.layout')

@section('content')
    <div class="container">
        <h1>Detalle de Orden</h1>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Orden N°{{$orden->id}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col">
                                        <strong>Estado</strong>
                                    </div>
                                    <div class="col text-right">
                                        @if($orden->estado == 'pagado')
                                            <strong style="color: green">PAGADO</strong>
                                            @elseif($orden->estado == 'pendiente')
                                            <strong style="color: orange">PENDIENTE</strong>
                                        @else
                                            <strong style="color: red">RECHAZADO</strong>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col">
                                        Fecha y hora
                                    </div>
                                    <div class="col text-right">
                                        {{ $orden->created_at->timezone('America/Santiago')->format('d/m/Y') .' -- '. $orden->created_at->timezone('America/Santiago')->format('H:i')}}
                                    </div>
                                </div>
                            </div>

                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col">
                                        <strong>Tipo de pago</strong>
                                    </div>
                                    <div class="col text-right">
                                        {{$orden->tipo_pago}}
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col">
                                        <strong>Monto</strong>
                                    </div>
                                    <div class="col text-right" style="color: green;font-weight: bold">
                                        <?php $total = $orden->envio ? $cart->precioTotal + $orden->envio: $cart->precioTotal; ?>
                                       $ {{ number_format($total, 0, '', '.') }}
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col">
                                        Productos
                                    </div>
                                    <div class="col text-right">
                                        <a href="#modal-cart" data-toggle="modal">Ver</a>
                                    </div>
                                <div class="modal fade" id="modal-cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detalles de la compra</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($cart->items as $producto)
                                                    <div class="list-group">
                                                        <div class="list-group-item" style="display: table">
                                                            <div style="display: table-cell">
                                                                <img style="max-height: 50px" src="{{asset('images/uploads/productos') .'/' . $producto['item']['img'] }}" alt="">
                                                            </div>
                                                            <div style="display: table-cell;">{{$producto['item']['nombre']}}</div>
                                                            <div style="display: table-cell;width:30%">{{$producto['cantidad']}} x $ {{number_format($producto['item']['precio'],0,'','.')}}</div>
                                                            <div style="display: table-cell;width:20%"><strong>$ {{number_format($producto['precio'],0,'','.')}}</strong></div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <hr>
                            <h5 for="">Datos del cliente</h5>
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col">
                                        <strong>Nombre</strong>
                                    </div>
                                    <div class="col text-right">
                                        {{$orden->nombre}}
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row">
                                    @if($orden->direccion)
                                    <div class="col">
                                        <strong>Entrega</strong>
                                    </div>
                                    <div class="col text-right">
                                        <a href="#direccion-collapse" data-toggle="collapse" role="button">DESPACHO A DOMICILIO</a>
                                    </div>
                                    @else
                                        <div class="col">
                                            <strong>Entrega</strong>
                                        </div>
                                        <div class="col text-right" style="color: green">
                                            <strong>RETIRO EN TIENDA</strong>
                                        </div>
                                    @endif

                                </div>
                                <div class="collapse" id="direccion-collapse">
                                    <div class="card">
                                        <div class="card-body">
                                            {{$orden->direccion}}
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col">
                                        <strong>Telefono</strong>
                                    </div>
                                    <div class="col text-right">
                                        {{$orden->telefono}}
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col">
                                        <strong>Email</strong>
                                    </div>
                                    <div class="col text-right">
                                        {{$orden->email}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @if($orden->estado == 'pagado')
                        <div class="list-group">
                            <h5>Datos WebPay Transaction</h5>
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col">
                                        <strong>Monto transferido</strong>
                                    </div>
                                    <div class="col text-right" style="color:green">

                                        <strong>{{$orden->webpayOrdens->amount}}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col">
                                        <strong>Fecha de la transaccion</strong>
                                    </div>
                                    <div class="col text-right">

                                        {{$orden->webpayOrdens->transaction_date}}
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col">
                                        <strong>ID de Sesion</strong>
                                    </div>
                                    <div class="col text-right">
                                        {{$orden->webpayOrdens->session_id}}
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col">
                                        <strong>N° Tarjeta</strong>
                                    </div>
                                    <div class="col text-right">

                                        **** **** **** {{$orden->webpayOrdens->card_number}}
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col">
                                        <strong>Cuotas</strong>
                                    </div>
                                    <div class="col text-right">

                                        {{$orden->webpayOrdens->shares_number}}
                                    </div>
                                </div>
                            </div>

                        </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



