@extends('frontend.templates.principal')

@section('content')

<div id="contact-page" class="container" style="margin-bottom: 60px">
    <h1 class="titulo-principal">Contacto</h1>
    <hr>
    <div class="row">
        <div class="col-lg-7">
            <form class="mensaje-form" action="{{ url('/contacto') }}" method="POST">
                @csrf
                <h1 style="margin:0">Necesitas contactarnos?</h1>
                <hr>
                <label>MOTIVO DEL MENSAJE</label>
                <div class="motivo-mensaje-container">
                    <div class="consulta icon-cont active" data-motivo="consulta">
                        <input class="display-none" type="radio" name="motivo" value="consulta" id="motivo-consulta">
                        <div class="icon">
                            <i class="fa fa-question"></i>
                        </div>
                        <div class="text">
                            Consulta
                        </div>
                    </div>
                    <div class="sugerencia icon-cont" data-motivo="sugerencia">
                        <input class="display-none" type="radio" name="motivo" value="sugerencia" id="motivo-sugerencia">
                        <div class="icon">
                            <i class="fa fa-user-edit"></i>
                        </div>
                        <div class="text">
                            Sugerencia
                        </div>
                    </div>
                    <div class="reclamo icon-cont" data-motivo="reclamo">
                        <input class="display-none" type="radio" name="motivo" value="reclamo" id="motivo-reclamo">
                        <div class="icon">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="text">
                            Reclamo
                        </div>
                    </div>
                </div>
                @if($errors->has('motivo'))
                <p style="color:red">Debes seleccionar un motivo para tu mensaje</p>
                @endif
                <hr>
                <label class="">DATOS DEL CLIENTE</label>
                @if(!Auth::check())
                <div class="form-group">
                    <input name="name" class="form-control" type="text" placeholder="Tu nombre" value="{{old('name')}}">
                    <input name="lastname" class="form-control" type="text" placeholder="tu apellido" value="{{old('lastname')}}">
                </div>
                @error('name')
                    <p style="color:red">{{$message}}</p>
                    @enderror
                    @error('lastname')
                    <p style="color:red">{{$message}}</p>
                    @enderror
                <div class="form-group">
                    <input name="email" class="form-control" type="text" placeholder="tu correo" value="{{old('email')}}">
                    <input name="telefono" class="form-control" type="text" placeholder="tu telefono" value="{{old('telefono')}}">
                </div>
                    @error('email')
                    <p style="color:red">{{$message}}</p>
                    @enderror
                    @error('telefono')
                    <p style="color:red">{{$message}}</p>
                    @enderror
                @else
                <div class="list-group">
                    <div class="list-group-item">
                        Nombre: {{ Auth::user()->name.' '.Auth::user()->lastname }}
                    </div>
                    <div class="list-group-item">
                        Email: {{ Auth::user()->email }}
                    </div>
                    <div class="list-group-item">
                        Telefono: {{ Auth::user()->telefono }}
                    </div>
                </div>
                @endif
                <hr>
                <label class="">MENSAJE</label>
                <div class="form-group">
                    <input name="asunto" class="form-control" type="text" placeholder="Asunto">
                </div>
                @error('asunto')
                <p style="color:red">{{$message}}</p>
                @enderror
                <div class="form-group">
                    <input class="form-control" type="number" placeholder="N° Orden de Compra (Opcional)" name="orden">
                </div>
                <div class="textarea-contacto">
                    <textarea class="form-control" name="mensaje" id="" rows="6" placeholder="Su mensaje"></textarea>
                </div>
                @error('mensaje')
                <p style="color:red">{{$message}}</p>
                @enderror

                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-envelope-open-text"></i>
                    Enviar Mensaje</button>

            </form>
        </div>
        <div class="col-lg-5">
            <div class="col-sm-12">
                <h2 class="title text-center"> <strong>Ubicanos</strong></h2>
                <div id="gmap" class="contact-map">
                </div>
            </div>
            <hr>
            <div class="col-sm-12 contacto-card">
                <div class="icon dir-icon">
                    <i class="fa fa-map-marker-alt marker"></i>
                </div>
                @if($tienda->cert)
                <div class="cert">
                    <i class="fa fa-{{ $tienda->cert->ubicacion ? 'check' : 'times' }}-circle check" style="color:{{ $tienda->cert->ubicacion ? '#0f9500' :'red' }}"></i>
                </div>
                @endif
                <div class="text">
                    @if(count($tienda->direccion)>0)
                    <div>{{ ($tienda->direccion[0]->calle ?? '').' '.($tienda->direccion[0]->numero ?? '') }}</div>
                    <div>{{$tienda->direccion[0]->poblacion ?? ''}}</div>
                    <div>{{$tienda->direccion[0]->ciudad ?? ''}}</div>
                        @else
                        <div><strong>Esta tienda no posee dirección física</strong></div>
                    @endif
                </div>
            </div>
            <div class="col-sm-12 contacto-card">
                <div class="icon">
                    <i class="fa fa-phone"></i>
                </div>
                @if($tienda->cert)
                <div class="cert">
                    <i class="fa fa-{{ $tienda->cert->telefonico ? 'check' : 'times' }}-circle check" style="color:{{ $tienda->cert->telefonico ? '#0f9500' :'red' }}"></i>
                </div>
                @endif
                <div class="text">
                    <p>{{ $tienda->telefono }}</p>
                </div>
            </div>
            <div class="col-sm-12 contacto-card">
                <div class="icon">
                    <i class="fa fa-envelope"></i>
                </div>
                @if($tienda->cert)
                    <div class="cert">
                        <i class="fa fa-check-circle check" style="color:transparent !important"></i>
                    </div>
                @endif
                <div class="text">
                    <p>{{ $tienda->email }}</p>
                </div>
            </div>
        </div>
    </div>
</div><!--/#contact-page-->

    @endsection
