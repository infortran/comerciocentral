@extends('backend.layout')

@section('content')
    <div class="container">
        <h1>Bienvenido {{ $tienda->user->name }}</h1>
        <div class="row"><!--TABLERO HOME-->
            <div class="col tablero-home card-admin">
                <div class="icon-container new-users">
                    <div class="icon"></div>
                    <i class="fa fa-users"></i>
                </div>
                <div class="text-container">
                    <div class="numero-cont">
                        <div class="numero">{{ count($tienda->clientes()->whereRaw('MONTH(cliente_tienda.created_at) = '. now()->month)->where('cliente', true)->get()) }}</div>
                        <div class="text">
                            {{ count($tienda->clientes()->whereRaw('MONTH(cliente_tienda.created_at) = '. now()->month)->where('cliente', true)->get()) > 1 ? 'Nuevos Clientes':'Nuevo Cliente' }}
                            </div>
                    </div>
                    <div class="subtext">Durante este mes</div>
                </div>
            </div>
            <div class="col tablero-home card-admin tab-2">
                <div class="icon-container msjes">
                    <div class="icon"></div>
                    <i class="fa fa-envelope-open"></i>
                </div>
                <div class="text-container">
                    <div class="numero-cont">
                        <div class="numero">5</div>
                        <div class="text">Mensajes sin leer</div>
                    </div>
                    <div class="subtext">3 Reclamos</div>
                </div>
            </div>
            <div class="col tablero-home card-admin">
                <div class="icon-container puntaje">
                    <div class="icon"></div>
                    <i class="fa fa-star"></i>
                </div>
                <div class="text-container">
                    <div class="numero-cont">
                        <div class="numero">4.7</div>
                        <div class="text">Puntaje de la tienda</div>
                    </div>
                    <div class="subtext">3 Votos</div>
                </div>
            </div>
        </div><!--ROW TABLERO HOME-->

        <div class="row" style="margin-top: 15px">
            <div class="col col-sm-8 card-admin pedidos-home">
                <div class="pedidos-header">
                    <div class="text-container">
                        <div class="text">Pedidos por entregar</div>
                        <div class="subtext">Hoy Miercoles 5 Agosto 2020</div>
                    </div>
                    <div class="numero">10</div>
                </div>
                <hr>
                <div class="pedidos-body">
                    <!--FOREACH pedidos as pedido-->
                    <div class="pedido-card">
                        <div class="img-container">
                            <div class="user-img">
                                <img src="{{ asset('images/system/avatar.png') }}" alt="">
                            </div>
                            <div class="user-name">
                                Invitado
                            </div>
                        </div>
                        <div class="text-container">
                            <div class="main">
                                +56 9 4706 5823
                            </div>
                            <div class="sub">
                                <div>Pasaje papa silvestre II #485</div>
                                <div>Villa Juan Pablo II - San Felipe</div>
                            </div>
                        </div>
                        <div class="detalle-pedido text-center">
                            <div class="collapse text-left" id="collapse-pedido">
                                <!-- FOREACH carrito as producto -->
                                <div>2 x berlin de crema</div>
                                <div>3 x berlin de manjar</div>
                                <div class="ellipse-line">3 x churros tradicionales bañados en cocholate con azucar glass</div>
                                <div>2 x berlin de crema</div>
                                <div>3 x berlin de manjar</div>
                                <div>3 x churros tradicionales</div>
                                <!--ENDFOREACH carrito-->
                            </div>
                            <a class="btn btn-comerciocentral" href="#collapse-pedido" data-toggle="collapse">
                                <i class="fa fa-eye"></i>
                                <strong>Ver pedido</strong>
                            </a>
                        </div>
                        <div class="precio">
                            <div>$ 1.000</div>
                            <div><span class="badge badge-success">Pagado</span></div>
                        </div>

                        <button class="btn btn-comerciocentral" title="Entregar Pedido" data-toggle="tooltip" data-placement="top">
                            <i class="fa fa-shipping-fast"></i>
                        </button>
                    </div>
                    <!--END FOREACH pedidos-->
                </div>
            </div>

            <div class="col card-admin evals-home">
                <div class="evals-header">
                    <div class="text-container">
                        <div class="text">Ultimas evaluaciones</div>
                        <div class="subtext">de los clientes</div>
                    </div>
                </div>
                <hr>
                <div class="evals-body">
                    @for($i = 0; $i < 5; $i++)
                    <div class="eval-card">
                        <div class="img-cont">
                            <div class="user-img">
                                <img src="{{ asset('images/system/avatar.png') }}" alt="">
                            </div>
                            <div class="user-name">Freddy</div>
                        </div>
                        <div class="text-cont">
                            Muy buena atencion y puntuales con la entrega
                            muy buen calidad de sus productos equis de equis de de de de de

                        </div>
                        <div class="puntos-cont">
                            <i class="fa fa-star"></i>
                            5.0
                        </div>
                    </div><!-- END CARD -->
                    @endfor
                </div>

            </div><!-- end COL -->

        </div>
    </div>
    @endsection
