@extends('frontend.templates.principal')

@section('content')

    <div class="container">
        <h1 class="titulo-principal">Certificaciones</h1>
        <hr>
        <div class="row">
            @if($tienda->cert)
            <div class="col-lg-8">
                <div class="panel panel-default"  style="border:1px solid #cfcfcf; border-radius: 10px"  >

                    <div class="panel-body">
                        <div class="certs">
                            
                            <div class="icon-certs">
                                @if($tienda->cert->ubicacion)
                                    <img style="max-height: 80px;" src="{{asset('images/system/certs-icon.png')}}" alt="">
                                    @else
                                <svg width="70" height="70">
                                    <circle r="35" cx="35" cy="35" style="fill:red"></circle>
                                </svg>
                                <i class="fa fa-exclamation-triangle"></i>
                                    @endif
                            </div>
                            <div class="certs-text">
                                <div class="certs-title" style="color:{{ $tienda->cert->ubicacion ? '#10b800' : 'red' }}">

                                    Certificado de Ubicación física
                                </div>
                                <div class="certs-descripcion">
                                    @if($tienda->cert->ubicacion)
                                    Hemos certificado que la ubicación de esta tienda
                                    pertenece a la dirección señalada en el formulario.
                                    @else
                                    No hemos podido comprobar la ubicación señalada
                                        en el formulario.
                                    @endif
                                </div>
                                <div class="certs-info">
                                    {{ strtoupper($tienda->direccion->first()->calle).' #'.
                                    $tienda->direccion->first()->numero
                                    }}
                                    <div>{{ strtoupper($tienda->direccion->first()->poblacion) }}</div>
                                    <div>{{ strtoupper($tienda->direccion->first()->ciudad) }}</div>
                                </div>
                            </div>
                            <div class="certs-img">
                                @if($tienda->cert->ubicacion)
                                <img src="{{ asset('images/uploads/tiendas/ubicaciones').'/'. $tienda->cert->certdata->img_ubicacion }}" alt="">
                                    @else
                                    <img src="{{ asset('images/system/image.png') }}" alt="">
                                @endif
                            </div>
                        </div>

                        <hr>
                        <div class="certs">
                            <div class="icon-certs">
                                @if($tienda->cert->admin)
                                    <img style="max-height: 80px;" src="{{asset('images/system/certs-icon.png')}}" alt="">
                                @else
                                    <svg width="70" height="70">
                                        <circle r="35" cx="35" cy="35" style="fill:red"></circle>
                                    </svg>
                                    <i class="fa fa-exclamation-triangle"></i>
                                @endif
                            </div>
                            <div class="certs-text">
                                <div class="certs-title"  style="color:{{ $tienda->cert->admin ? '#10b800' : 'red' }}">

                                    Certificado de Administrador
                                </div>
                                <div class="certs-descripcion">
                                    @if($tienda->cert->admin)
                                    Hemos certificado la identidad del administrador de esta tienda.
                                    @else
                                        Aun no podemos verificar la identidad del administrador de esta tienda.
                                    @endif
                                </div>
                                <div class="certs-info">
                                    @if($tienda->cert->admin)
                                        <div>{{strtoupper($tienda->cert->certdata->nombre_admin)}}</div>
                                        <div>{{ $tienda->cert->certdata->run_admin }}</div>
                                        @else
                                    <div>Nombre del usuario registrado:</div>
                                    {{ strtoupper($tienda->users->first()->name).' '.strtoupper($tienda->users->first()->lastname) }}
                                        @endif
                                </div>
                            </div>
                            <div class="certs-img cert-admin-img">
                                @if($tienda->cert->admin)
                                <img src="{{ asset('images/uploads/users').'/'. $tienda->cert->certdata->img_admin }}" alt="">
                                    @else

                                @endif
                            </div>
                        </div>
                        <hr>

                        <div class="certs">
                            <div class="icon-certs">
                                @if($tienda->cert->tributario)
                                    <img style="max-height: 80px;" src="{{asset('images/system/certs-icon.png')}}" alt="">
                                @else
                                    <svg width="70" height="70">
                                        <circle r="35" cx="35" cy="35" style="fill:red"></circle>
                                    </svg>
                                    <i class="fa fa-exclamation-triangle"></i>
                                @endif
                            </div>
                            <div class="certs-text">
                                <div class="certs-title" style="color:{{ $tienda->cert->tributario ? '#10b800' : 'red' }}">
                                    Certificado tributario
                                </div>
                                <div class="certs-descripcion">
                                    @if($tienda->cert->tributario)
                                    Hemos certificado que la informacion tributaria de esta tienda es válida
                                    ante el servicio de impuestos internos (SII).
                                        @else
                                        No hemos podido verificar la información tributaria de esta tienda
                                    @endif
                                </div>
                                <div class="certs-info" style="font-size: 20px">
                                    @if($tienda->cert->tributario)
                                    R.U.T. {{ $tienda->cert->certdata->rut_tributario }}
                                        @endif
                                </div>
                            </div>
                            <div class="certs-img">

                            </div>
                        </div>
                        <hr>



                        <div class="certs">
                            <div class="icon-certs">
                                @if($tienda->cert->delivery)
                                    <img style="max-height: 80px;" src="{{asset('images/system/certs-icon.png')}}" alt="">
                                @else
                                    <svg width="70" height="70">
                                        <circle r="35" cx="35" cy="35" style="fill:red"></circle>
                                    </svg>
                                    <i class="fa fa-exclamation-triangle"></i>
                                @endif
                            </div>
                            <div class="certs-text">
                                <div class="certs-title" style="color:{{ $tienda->cert->delivery ? '#10b800' : 'red' }}">

                                    Certificado de Delivery
                                </div>
                                <div class="certs-descripcion">
                                    @if($tienda->cert->delivery)
                                    Hemos certificado la siguiente información entregada confirmando el delivery oficial
                                    de esta tienda.
                                        @else
                                        No hemos podido certificar el delivery que realizará las entregas de esta tienda.
                                    @endif
                                </div>
                                <div class="certs-info">

                                </div>
                            </div>
                            <div class="certs-img">
                                @if($tienda->cert->delivery)
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <div style="padding:0" class="carousel-inner" role="listbox">
                                            @foreach($tienda->deliveries as $key => $delivery)
                                            <div style="padding: 0" class="item {{ $key == 0 ? 'active' : '' }}">
                                                <img style="height: 140px" src="{{ asset('images/uploads/deliveries').'/'. $delivery->img }}" alt="">
                                                <div class="carousel-caption certs-info">
                                                    {{ $delivery->nombre }}
                                                </div>
                                            </div>
                                                @if($delivery->vehiculo_img)
                                                    <div style="padding: 0" class="item">
                                                        <img style="height: 140px" src="{{ asset('images/uploads/deliveries').'/'. $delivery->vehiculo_img }}" alt="">
                                                        <div class="carousel-caption certs-info">
                                                            <div>Patente:</div>
                                                             <div>{{ $delivery->patente }}</div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @else
                                <img src="{{ asset('images/uploads/deliveries/nodelivery.jpg') }}" alt="">
                                    @endif
                            </div>
                        </div>
                        <hr>

                        <div class="certs">
                            <div class="icon-certs">
                                @if($tienda->cert->telefonico)
                                    <img style="max-height: 80px;" src="{{asset('images/system/certs-icon.png')}}" alt="">
                                @else
                                    <svg width="70" height="70">
                                        <circle r="35" cx="35" cy="35" style="fill:red"></circle>
                                    </svg>
                                    <i class="fa fa-exclamation-triangle"></i>
                                @endif
                            </div>
                            <div class="certs-text">
                                <div class="certs-title" style="color:{{ $tienda->cert->telefonico ? '#10b800' : 'red' }}">

                                    Certificado de Numero telefónico
                                </div>
                                <div class="certs-descripcion">
                                    @if($tienda->cert->telefonico)
                                    Hemos certificado que el siguiente número de telefono corresponde a la tienda.
                                        @else
                                        No hemos podido verificar el número telefónico asociado a esta tienda.
                                    @endif
                                </div>
                                <div class="certs-info" >
                                    <div style="font-size: 20px">{{$tienda->telefono}}</div>
                                    @if($tienda->cert->telefonico)
                                    <div>de {{ date('g:ia', strtotime($tienda->cert->certdata->hora_inicio_tel)) }} a
                                        {{ date('g:ia', strtotime($tienda->cert->certdata->hora_fin_tel)) }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="certs-img">

                            </div>
                        </div>
                        <hr>
                        @if($tienda->cert->sanitario)
                        <div class="certs">
                            <div class="icon-certs">
                                @if($tienda->cert->sanitario)
                                    <img style="max-height: 80px;" src="{{asset('images/system/certs-icon.png')}}" alt="">
                                @else
                                    <svg width="70" height="70">
                                        <circle r="35" cx="35" cy="35" style="fill:red"></circle>
                                    </svg>
                                    <i class="fa fa-exclamation-triangle"></i>
                                @endif
                            </div>
                            <div class="certs-text">
                                <div class="certs-title" style="color:{{ $tienda->cert->certdata->res_sanitaria ? '#10b800' : '#C89600' }}">

                                    Certificado Sanitario
                                </div>
                                <div class="certs-descripcion">
                                    @if($tienda->cert->sanitario && $tienda->cert->certdata->res_sanitaria)
                                    Hemos certificado que la resolucion sanitaria de esta tienda cuenta
                                    con los permisos necesarios para la fabricacion de alimentos.
                                        @else
                                        Hemos certificado que esta tienda cuenta con un lugar habilitado
                                        pra la preparacion de alimentos, pero no posee una resolucion sanitaria.
                                    @endif
                                </div>
                                <div class="certs-info">
                                    @if($tienda->cert->certdata->res_sanitaria && $tienda->cert->sanitario)
                                    <div>Resolucion Sanitaria :</div>
                                    <div style="font-size: 20px">N° {{ $tienda->cert->certdata->res_sanitaria }}</div>
                                    @endif

                                </div>
                            </div>
                            <div class="certs-img">
                            </div>
                        </div>
                        @endif







                    </div>
                </div>
            </div><!-- col-md-8 fin-->
                @else
                <div class="col-lg-8">
                    <div class="panel panel-default no-certificate" style="">
                        <div class="no-cert-icon">
                            <svg width="100" height="100">
                                <circle r="50" cx="50" cy="50" style="fill:#f30000"></circle>
                            </svg>
                            <i class="fa fa-times" style=""></i>
                        </div>

                        <div>
                            <h3>Esta tienda no posee ningun certificado</h3>
                            <p style="width: 60%;display:block;margin: 0 auto">Te recomendamos tener mucho cuidado al comprar en una tienda
                            que no ha sido certificada</p>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-4">
                <div class="eval eval-puntuacion text-center">
                    <div class="title">Puntuación</div>
                    <div class="points">{{ number_format($puntaje, 1) }}</div>
                    <div class="stars">
                        @if($puntaje > 0.4 && $puntaje < 1)
                            <div class="media-estrella">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half"></i>
                            </div>
                        @else
                            <i class="fa fa-star" style="color:{{ $puntaje >= 1 ? '#ffab00' : ''}}"></i>
                        @endif

                        @if($puntaje > 1.4 && $puntaje < 2)
                            <div class="media-estrella">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half"></i>
                            </div>
                        @else
                            <i class="fa fa-star" style="color:{{ $puntaje >= 2 ? '#ffab00' : ''}}"></i>
                        @endif

                        @if($puntaje > 2.4 && $puntaje < 3)
                            <div class="media-estrella">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half"></i>
                            </div>
                        @else
                            <i class="fa fa-star" style="color:{{ $puntaje >= 3 ? '#ffab00' : ''}}"></i>
                        @endif


                        @if($puntaje > 3.4 && $puntaje < 4)
                            <div class="media-estrella">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half"></i>
                            </div>
                        @else
                            <i class="fa fa-star" style="color:{{ $puntaje >= 4 ? '#ffab00' : ''}}"></i>
                        @endif
                        @if($puntaje > 4.4 && $puntaje < 5)
                            <div class="media-estrella">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half"></i>
                            </div>
                        @else
                            <i class="fa fa-star" style="color:{{ $puntaje >= 5 ? '#ffab00' : ''}}"></i>
                        @endif

                    </div>
                    <div class="users-votes">
                        <i class="fa fa-users"></i>
                        <strong>{{ count($tienda->ratings) }}</strong>
                        <div><small>votos</small></div>
                    </div>
                </div>
                <h4 style="margin-top:20px;text-align: center;color:var(--color-primary);">ULTIMAS OPINIONES</h4>
                @foreach($tienda->ratings->take(5) as $rating)
                <div class="eval-card">
                    <div class="img-cont">
                        <div class="user-img">
                            <img src="{{ asset('images/uploads/users/').'/'.$rating->rating->user->img }}" alt="">
                        </div>
                        <div class="user-name">{{$rating->rating->user->name}}</div>
                    </div>
                    <div class="text-cont">
                        {{$rating->comentario}}

                    </div>
                    <div class="puntos-cont">
                        <i class="fa fa-star"></i>
                        {{number_format($rating->rating->voto,1)}}
                    </div>
                </div><!-- END CARD -->
                    @endforeach
            </div>
        </div>
    </div>

    <div class="container-fluid banner-inferior-container" style="margin-top: 30px">
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
