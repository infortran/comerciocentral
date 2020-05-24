@extends('frontend.templates.principal')

@section('content')
    <section>
        <div class="container">
            <div class="row text-center" style="margin-bottom: 20px">
                <img style="max-height: 250px" class="center-block" src="{{asset('images/system/success.gif')}}" alt="">
                <h2>Muchas gracias por tu compra</h2>
                <h4>Al confirmar el deposito, enviaremos un correo electronico</h4>
                <small>Con los datos de tu boleta electrónica</small>
                <hr>
                <a href="{{url('/')}}">
                    <button class="btn-default btn" style="padding:20px 30px !important;margin-top:16px">
                        <i class="fa fa-home"></i>
                        Volver al Inicio
                    </button>
                </a>

                <a href="{{url('/cuenta')}}">
                    <button class="btn-primary btn">
                        <i class="fa fa-address-card"></i>
                        Ir a tu cuenta
                    </button>
                </a>
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <h4>Datos de tu compra</h4>
                        </div>
                        <div class="panel-body">
                            <div class="list-group text-center">
                                <div class="list-group-item">
                                    La orden sera entregada a...
                                </div>
                                <div class="list-group-item">
                                    <strong>{{ $nombre }}</strong>
                                </div>
                            </div>
                            <div class="list-group text-center">
                                <div class="list-group-item">
                                    Direccion de entrega
                                </div>
                                <div class="list-group-item">
                                    <strong>{{ $direccion }}</strong>
                                </div>
                            </div>
                            <div class="list-group text-center">
                                <div class="list-group-item">
                                    Numero de Orden
                                </div>
                                <div class="list-group-item">
                                    <strong style="font-size: 25px">{{ $nro_orden }}</strong>
                                </div>
                            </div>
                            <div class="list-group text-center">
                                <div class="list-group-item">
                                    Monto
                                </div>
                                <div class="list-group-item">
                                    <strong style="font-size: 25px">$ {{ number_format($monto, 0,'','.') }}</strong>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
