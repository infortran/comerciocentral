@extends('main.templates.principal')

@section('content')
    <div class="slider_area">
        <div class="single_slide slider_bg_2">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto" style="margin:100px auto">
                        <div class="wizard-v1-content">
                            <div class="wizard-form">
                                <form class="form-register" id="form-register" action="{{ route('main.register.submit') }}" method="post" autocomplete="off">
                                    @csrf
                                    <div id="form-total">
                                        <!-- SECTION 1 -->
                                        <h2>
                                            <span class="step-icon"><i class="zmdi zmdi-account fa fa-user-plus"></i></span>
                                            <span class="step-number">Paso 1</span>
                                            <span class="step-text">Tus datos personales</span>
                                        </h2>
                                        <section>
                                            <div class="inner">
                                                <div class="form-row">
                                                    <div class="form-holder form-holder-2">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-6">
                                                                <label for="username">Nombre*</label>
                                                                <input type="text" placeholder="Primer nombre" class="form-control" id="username" name="username" required>
                                                            </div>
                                                            <div class="col-12 col-lg-6">
                                                                <label for="username">Apellido*</label>
                                                                <input type="text" placeholder="Apellido paterno" class="form-control" id="userlastname" name="userlastname" required>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="form-row">
                                                    <div class="form-holder form-holder-2">
                                                        <label for="email">Correo Electronico*</label>
                                                        <input autocomplete="off" type="email" placeholder="tucorreo@ejemplo.com" class="form-control" id="email" name="email" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
                                                        <label id="email_error" class="d-none" style="color:red">
                                                            <i class="fa fa-times-circle"></i>
                                                            Este correo ya esta registrado
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-holder form-holder-2">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-6">
                                                                <label for="password">Contraseña*</label>
                                                                <input type="password" placeholder="Debe contener al menos 8 caracteres" class="form-control" id="password" name="password">
                                                            </div>
                                                            <div class="col-12 col-lg-6">
                                                                <label for="confirm_password">Confirma tu Contraseña*</label>
                                                                <input type="password" placeholder="Repite tu contraseña ingresada" class="form-control" id="confirm_password" name="confirm_password">
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </section>
                                        <!-- SECTION 2 -->
                                        <h2>
                                            <span class="step-icon"><i class="zmdi zmdi-card fa fa-store"></i></span>
                                            <span class="step-number">Paso 2</span>
                                            <span class="step-text">Datos de tu tienda</span>
                                        </h2>
                                        <section>
                                            <div class="inner">
                                                <div class="form-row">
                                                    <div class="form-holder form-holder-2">
                                                        <label for="card-type">Nombre de tu tienda</label>
                                                        <input type="text" name="nombre_tienda" id="nombre-tienda" value="{{ $nombre_tienda ?? '' }}" required>
                                                    </div>
                                                    <p id="domain-dinamic" class="text-center" style="color:#00023d">
                                                        <i id="domain-dinamic-symbol" class="fa fa-check-circle" style="color: green"></i>
                                                        https://<strong id="domain-tienda" style="color:#6d2ead">{{ $domain ?? '' }}</strong>.comerciocentral.cl
                                                    </p>
                                                </div>
                                                <div class="form-row">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-holder form-holder-2">
                                                                <label for="card-number">Correo de tu tienda</label>
                                                                <input type="email" name="email_tienda" class="card-number" id="email-tienda" placeholder="ej: tutienda@gmail.com" required>
                                                                <label id="email_tienda_error" class="d-none" style="color:red">
                                                                    <i class="fa fa-times-circle"></i>
                                                                    Este correo ya esta registrado
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-holder form-holder-2">
                                                                <label for="cvc">Telefono de tu tienda</label>
                                                                <input type="text" name="telefono_tienda" class="cvc" id="telefono-tienda" placeholder="ej: 912345678" required>
                                                            </div>
                                                        </div>
                                                    </div>






                                                </div>
                                                <div class="form-row">
                                                    <div class="form-holder form-holder-2">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <label for="">Informacion sobre tu tienda</label>
                                                                <textarea name="info_tienda" id="info-tienda" style="border-radius: 5px !important" required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </section>
                                        <!-- SECTION 3 -->
                                        <h2>
                                            <span class="step-icon"><i class="zmdi zmdi-receipt fa fa-clipboard-check"></i></span>
                                            <span class="step-number">Paso 3</span>
                                            <span class="step-text">Confirma tus datos</span>
                                        </h2>
                                        <section>
                                            <div class="inner">
                                                <h3>Confirmar tus datos y tu tienda</h3>
                                                <div class="form-row table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                        <tr class="space-row">
                                                            <th>Tu nombre:</th>
                                                            <td id="user-fullname-val"></td>
                                                        </tr>
                                                        <tr class="space-row">
                                                            <th>Correo:</th>
                                                            <td id="email-val"></td>
                                                        </tr>
                                                        <tr class="space-row">
                                                            <th>Nombre de tu tienda:</th>
                                                            <td id="nombre-tienda-val"></td>
                                                        </tr>
                                                        <tr class="space-row">
                                                            <th>Url de tu tienda:</th>
                                                            <td id="url-tienda-val"></td>
                                                        </tr>
                                                        <tr class="space-row">
                                                            <th>Correo de tu tienda:</th>
                                                            <td id="email-tienda-val"></td>
                                                        </tr>
                                                        <tr class="space-row">
                                                            <th>Telefono de tu tienda:</th>
                                                            <td id="tel-tienda-val"></td>
                                                        </tr>
                                                        <tr class="space-row">
                                                            <th>Info de tu tienda:</th>
                                                            <td id="info-tienda-val"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </form>
                            </div>
                        </div><!-- fin wizard -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
