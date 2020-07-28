@extends('backend.layout')

@section('content')
    <div class="container">

        <h1>Clientes

        </h1>
        <!-- ============================
          FORMULARIO DE BUSQUEDA
          ================================= -->
        <div class="container" style="margin-top: 20px">
            <div class="row">
                <form class="search-form">
                    <input name="search" type="text" class="textbox" placeholder="Buscar usuarios">
                    <button title="Search" value="" type="submit" class="button">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>


        @if($search)
            <div class="alert alert-info">Resultados para tu busqueda <strong>"{{$search}}"</strong></div>
        @endif
    <!--.fin FORM busqueda-->



        <hr>
        <!---....FIN FORMULARIO BUSQUEDA.....-->
        <div class="row">
            <div class="col-10">
                <div style="">
                    principal
                </div>
            </div>

            <div class="col-2">

            </div>
        </div>

    </div>
@endsection
