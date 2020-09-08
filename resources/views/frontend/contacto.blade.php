@extends('frontend.templates.principal')

@section('content')

<div id="contact-page" class="container" style="margin-bottom: 60px">
    <h1 class="titulo-principal">Contacto</h1>
    <hr>
    <div class="row">

        <div class="col-lg-7">

            <form class="mensaje-form mensaje-container" id="form-enviar-mensaje-ajax">
                @csrf
                <h1 style="margin:0">Necesitas contactarnos?</h1>
                <hr>
                <label>MOTIVO DEL MENSAJE</label>
                <div class="motivo-mensaje-container">
                    <div class="consulta icon-cont active" data-motivo="consulta">
                        <input class="display-none motivo-contacto" type="radio" name="motivo" value="consulta" id="motivo-consulta">
                        <div class="icon">
                            <i class="fa fa-question"></i>
                        </div>
                        <div class="text">
                            Consulta
                        </div>
                    </div>
                    <div class="sugerencia icon-cont" data-motivo="sugerencia">
                        <input class="display-none motivo-contacto" type="radio" name="motivo" value="sugerencia" id="motivo-sugerencia">
                        <div class="icon">
                            <i class="fa fa-user-edit"></i>
                        </div>
                        <div class="text">
                            Sugerencia
                        </div>
                    </div>
                    <div class="reclamo icon-cont" data-motivo="reclamo">
                        <input class="display-none motivo-contacto" type="radio" name="motivo" value="reclamo" id="motivo-reclamo">
                        <div class="icon">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="text">
                            Reclamo
                        </div>
                    </div>
                </div>

                <p id="error-motivo" style="color:red"></p>

                <hr>
                <label class="">DATOS DEL CLIENTE</label>
                @if(!Auth::check())
                <div class="form-group">
                    <input id="name-contacto" name="name" class="form-control" type="text" placeholder="Tu nombre" value="{{old('name')}}">
                    <input id="lastname-contacto" name="lastname" class="form-control" type="text" placeholder="tu apellido" value="{{old('lastname')}}">
                </div>
                    <p id="error-name" style="color:red"></p>
                    <p id="error-lastname" style="color:red"></p>
                <div class="form-group">
                    <input id="email-contacto" name="email" class="form-control" type="text" placeholder="tu correo" value="{{old('email')}}">
                    <input id="telefono-contacto" name="telefono" class="form-control" type="text" placeholder="tu telefono" value="{{old('telefono')}}">
                </div>
                    <p id="error-email" style="color:red"></p>
                    <p id="error-telefono" style="color:red"></p>
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
                    <input id="asunto-contacto" name="asunto" class="form-control" type="text" placeholder="Asunto" value="{{old('asunto')}}">
                    <p id="error-asunto" style="color:red"></p>
                </div>

                <div class="form-group">
                    <input id="orden-contacto" class="form-control" type="number" placeholder="N° Orden de Compra (Opcional)" name="orden" value="{{old('orden')}}">
                </div>
                <div class="textarea-contacto">
                    <textarea class="form-control" name="mensaje" id="mensaje-contacto" rows="6" placeholder="Su mensaje">{{old('mensaje')}}</textarea>
                    <p id="error-mensaje" style="color:red"></p>
                </div>

                <div style="margin-top: 20px;" id="recaptcha-container">
                    <div id="recaptcha-contacto" class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                    <div>
                        <strong id="error-recaptcha" style="color:red"></strong>
                    </div>
                    <button id="btn-enviar-mensaje" class="btn-send" type="submit">
                        <i id="mensaje-success-icon" class="fa fa-check" style="color:green;display:none"></i>
                        <i id="mensaje-error-icon" class="fa fa-exclamation-triangle" style="display:none"></i>
                        <i id="mensaje-default-icon" class="fa fa-envelope-open-text"></i>
                        <div id="mensaje-text-btn" style="display:inline">Enviar Mensaje</div></button>
                </div>


            </form>
        </div>
        <div class="col-lg-5 map-contact-container">
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

                <div class="text">
                    <p>{{ $tienda->telefono }}</p>
                </div>
            </div>
            <div class="col-sm-12 contacto-card">
                <div class="icon">
                    <i class="fa fa-envelope"></i>
                </div>

                <div class="text">
                    <p>{{ $tienda->email }}</p>
                </div>
            </div>
        </div>
    </div>
</div><!--/#contact-page-->
    @include('frontend.templates.modals.modal-mensaje-enviado')
    @endsection
