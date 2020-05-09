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
                                        @elseif($orden->estado == 'deposito')
                                            <strong style="color: #00c7ff">DEPOSITO</strong>
                                        @else
                                            <strong style="color: red">RECHAZADO</strong>
                                        @endif
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
                                                    <div class="card">
                                                        <div class="card-body" style="display: table">
                                                            <td>
                                                                <img style="max-height: 50px" src="{{asset('images/uploads/productos') .'/' . $producto['item']['img'] }}" alt="">
                                                            </td>
                                                            <td>{{$producto['item']['nombre']}}</td>
                                                            <td>{{$producto['cantidad']}} x {{$producto['item']['precio']}}</td>
                                                            <td>{{$producto['precio']}}</td>
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
                                    <div class="col">
                                        <strong>Direccion</strong>
                                    </div>
                                    <div class="col text-right">
                                        <a href="#direccion-collapse" data-toggle="collapse" role="button">Ver</a>
                                    </div>

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



