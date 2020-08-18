@extends('backend.layout')

@section('content')

        <h1>Estado de Ordenes</h1>

        <div class="container">
            <div class="row"><!--TABLERO HOME-->
                <div class="col tablero-home card-admin">
                    <div class="icon-container ordenes-del-dia">
                        <div class="icon"></div>
                        <i class="fa fa-clipboard-list"></i>
                    </div>
                    <div class="text-container">
                        <div class="numero-cont">

                            <div class="text">Ordenes del dia</div>
                        </div>
                        @if($count_ordenes == 0)
                        <div class="subtext">esperando...</div>
                        @endif
                        <div class="numero">{{ $count_ordenes > 0 ? $count_ordenes : '' }}</div>
                    </div>
                </div>
                <div class="col tablero-home card-admin tab-2">
                    <div class="icon-container ordenes-pendientes">
                        <div class="icon"></div>
                        <i class="fa fa-shipping-fast"></i>
                    </div>
                    <div class="text-container">
                        <div class="numero-cont">
                            <div class="numero">{{ count($tienda->ordenes()->where('entrega', 'tienda')->get()) }}</div>
                            <div class="text">Pedidos por entregar</div>
                        </div>
                        <div class="subtext">{{ count($tienda->ordenes()->where('estado', 'transito')->get()) }} En transito</div>
                    </div>
                </div>
                <div class="col tablero-home card-admin">
                    <div class="icon-container total-dia">
                        <div class="icon"></div>
                        <i class="fa fa-donate"></i>
                    </div>
                    <div class="text-container">
                        <div class="numero-cont">
                            <div class="numero">$  {{number_format($totales['total_dia'],0,'','.')}} </div>
                            <div class="text">CLP</div>
                        </div>
                        <div class="subtext">$ {{number_format($totales['ventas_dia'],0,'','.')}} Ventas / $ {{number_format($totales['envios_dia'],0,'','.')}} Envio</div>
                    </div>
                </div>
            </div><!--ROW TABLERO HOME-->
        </div>
        <!-- ============================
          FORMULARIO DE BUSQUEDA
  ================================= -->
        <div class="container" style="margin-top: 20px">
            <div class="row">

                <form class="search-form">
                    <input name="search" type="number" class="textbox" placeholder="Ingrese el N° de Orden">
                    <button title="Search" value="" type="submit" class="button">
                        <i class="fa fa-search"></i>
                    </button>
                </form>

            </div>
        </div>


        @if($search)
            <div class="alert alert-info">Resultados para la orden  <strong>"N°{{$search}}"</strong></div>
    @endif
    <!--.fin FORM busqueda-->

        <div class="container">
            <div class="row">
                <div class="col">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Pedidos de hoy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                                Pedidos por entregar
                                <span class="badge badge-pill badge-danger">{{count($tienda->ordenes()->where('entrega', 'tienda')->get())}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Entregados</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="ordenes-index card-admin">
                                <div class="header">
                                    <div class="text-container">
                                        <div class="text">
                                            {{ $hoy  }}
                                        </div>
                                        <div class="subtext">
                                            @if($ordenes)
                                            4 pagadas / 3 pendientes / 1 cancelada
                                                @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="body">
                                    @foreach($ordenes as $orden)
                                    <div class="orden-card">
                                        <div class="id">
                                            <div class="texto">N° Orden</div>
                                            <div class="ord-cont">
                                                <div class="orden">{{$orden->number}}</div>
                                            </div>
                                            <div class="sub-orden">{{$orden->created_at->diffForHumans()}}</div>
                                        </div>
                                        <div class="user">
                                            <div class="img">
                                                <img src="{{asset('images/uploads/users').'/'.($orden->user->img ?? 'avatar.png')}}" alt="">
                                            </div>
                                            <div class="name">
                                                @if($orden->user)
                                                    {{ $orden->user->name.' '.$orden->user->lastname }}
                                                    @else
                                                    {{ $orden->nombre }}
                                                @endif
                                            </div>
                                            <div class="guest">
                                                @if($orden->user)
                                                    <span class="badge badge-primary">Cliente</span>
                                                @else
                                                <span class="badge">Invitado</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="precio-container">
                                            <div class="total">$ {{number_format($orden->total + $orden->envio,0,'','.')}}</div>
                                            <div class="subtotal-container">
                                                <div class="subtotal">Subtotal: $ {{number_format($orden->total,0,'','.')}}</div>
                                                @if($orden->envio > 0)
                                                <div class="envio">Envio: $ {{number_format($orden->envio,0,'','.')}}</div>
                                                    @else
                                                    <div class="envio">Envio: <strong style="color:{{is_null($orden->envio) ? '#cfcfcf':'green'}}">{{ is_null($orden->envio) ? 'Sin Envio': 'GRATIS' }}</strong></div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="status-container">
                                            @switch($orden->tipo_pago)
                                                @case('webpay')
                                                <div class="tipo">Tipo de pago: <span class="badge badge-warning">Webpay</span></div>
                                                @break
                                                @case('khipu')
                                                <div class="tipo">Tipo de pago: <span class="badge badge-info">Khipu</span></div>
                                                @break
                                                @case('deposito')
                                                <div class="tipo">Tipo de pago: <span class="badge badge-warning" style="background: var(--color-primary)">Deposito</span></div>
                                                @break
                                                @default
                                                <div class="tipo">Tipo de pago: <span class="badge badge-warning">Pago en efectivo</span></div>
                                                @break
                                            @endswitch
                                            <div class="status">Estado del pago:
                                                @switch($orden->estado)
                                                    @case('pagado')
                                                    <span class="badge badge-success">Pagado</span>
                                                    @break
                                                    @case('pendiente')
                                                    <span class="badge badge-dark">Pendiente</span>
                                                    @break
                                                    @case('rechazado')
                                                    <span class="badge badge-danger">Rechazado</span>
                                                    @break
                                                @endswitch
                                            </div>
                                            <div class="deliver">Transito:
                                                @switch($orden->entrega)
                                                    @case('entregado')
                                                    <strong>Entregado</strong>
                                                    @break
                                                    @case('tienda')
                                                    <strong>En tienda</strong>
                                                    @break
                                                    @case('transito')
                                                    <strong>En transito</strong>
                                                    @break
                                                    @endswitch
                                            </div>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-comerciocentral-2">Entregar pedido</button>
                                            <button type="button" class="btn btn-comerciocentral-2 dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Ver detalles</a>
                                                <a class="dropdown-item" href="#"></a>
                                                <a class="dropdown-item" href="#">Rechazar pedido</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Eliminar</a>
                                            </div>
                                        </div>
                                    </div>
                                        @endforeach
                                    <div>
                                        {{$ordenes->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                    </div>
                </div>
            </div>
        </div>
@endsection
