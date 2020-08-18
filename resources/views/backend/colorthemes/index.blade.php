@extends('backend.layout')

@section('content')
    <div class="container">
        <h1>Temas y Colores</h1>
        <div class="row">
            <div class="col-lg-9">
                Personaliza tu tienda cambiando los colores principales de la plantilla.
            </div>
        </div>

        <form action="{{ url('/admin/config/themes') }}" method="POST" class="row" style="margin-top: 50px">
            @csrf
            <div class="col-lg-2">
                <h5><strong>Colores de la plantilla</strong></h5>
                <p>Cambie los colores principales del sitio.</p>
            </div>

            <div class="col-lg-10 color-editor">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="list-group">
                            <div class="list-group-item d-flex">
                                <strong>Color principal</strong>
                                <input name="primario" type="color" class="color-right" value="{{ $tienda->colortheme->primario }}">
                            </div>
                            <div class="list-group-item d-flex">
                                <strong>Color secundario</strong>
                                <input name="secundario" type="color" class="color-right" value="{{ $tienda->colortheme->secundario }}">
                            </div>
                            <div class="list-group-item d-flex">
                                <strong>Color de fondo</strong>
                                <input name="background" type="color" class="color-right" value="{{ $tienda->colortheme->background }}">
                            </div>
                            <div class="list-group-item d-flex">
                                <strong>Color Texto normal</strong>
                                <input name="texto" type="color" class="color-right" value="{{ $tienda->colortheme->texto }}">
                            </div>
                            <div class="list-group-item d-flex">
                                <strong>Color texto suave</strong>
                                <input name="texto-claro" type="color" class="color-right" value="{{ $tienda->colortheme->texto_claro }}">
                            </div>
                            <div class="list-group-item d-flex">
                                <strong>Color texto boton</strong>
                                <input name="texto-btn" type="color" class="color-right" value="{{ $tienda->colortheme->texto_btn }}">
                            </div>
                        </div>
                        <button class="btn btn-comerciocentral" type="submit" style="margin-top: 20px">
                            <i class="fa fa-save"></i>
                            Guardar cambios
                        </button>
                    </div>
                    <div class="col-4 d-none  d-sm-block">
                        <div class="color-mock">
                            <div class="nav-mock"></div>
                            <div class="header-mock text-center">
                                <div>TEXTO PRIMARIO</div>
                            </div>
                            <div class="body-mock">
                                <div class="aside-mock"></div>
                                <div class="section-mock text-center">
                                    <div class="normal">texto normal</div>
                                    <div class="claro">texto claro</div>
                                </div>
                            </div>

                            <div class="footer-mock"></div>
                        </div>
                        <div class="btn-cont-mock">
                            <button class="btn-mock">boton ejemplo</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endsection
