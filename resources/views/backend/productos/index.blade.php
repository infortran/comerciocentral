<!--BACKEND-->
<!--INDEX DEL PRODUCTO-->

@extends('backend.layout')

@section('content')
<div class="container">
    <h1>Productos
        <a href="/admin/productos/create">
            <button class="addButton float-right"><i class="fas fa-plus" style="margin-right:10px"></i>Agregar nuevo producto</button>
        </a>
    </h1>

  <!-- ============================
          FORMULARIO DE BUSQUEDA
  ================================= -->
    <div class="container" style="margin-top: 20px">
        <div class="row">
            <form class="search-form">
                <input name="search" type="text" class="textbox" placeholder="Buscar">
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

  @foreach($productos as $producto)
    @include('backend.productos.modal-destroy')
  @endforeach


    <div class="container">
        <div class="row producto-container">
            @foreach($productos as $key => $producto)
            <div class="producto-row">
                <div class="main col-lg-8">
                    <div>
                        <input type="checkbox">
                    </div>
                    <div class="img-container">
                        <a href="{{ route('productos.edit', [$domain, $producto->id]) }}">
                            <img src="{{ asset('images/uploads/productos').'/'. $producto->img}}" alt="">
                        </a>

                    </div>
                    <div class=" sec">
                        <div><a href="{{ route('productos.edit', [$domain, $producto->id]) }}"><strong>{{ $producto->nombre }}</strong></a></div>
                        <div>
                            @if($producto->is_available)
                                {!! Form::open(['action' => ['ProductoController@setAvailability', $domain, $producto->id]]) !!}
                                <label class="switch">
                                    <input type="checkbox" checked onchange="this.form.submit()">
                                    <span class="slider round"></span>
                                </label>
                                <p style="position:relative;top:-28px;right:-35px; color:green"><strong>activado</strong></p>
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['action' => ['ProductoController@setAvailability', $domain,$producto->id]]) !!}
                                <label class="switch">
                                    <input type="checkbox" onchange="this.form.submit()">
                                    <span class="slider round"></span>
                                </label>
                                <p style="position:relative;top:-28px;right:-35px; color:#cfcfcf"><strong>desactivado</strong></p>
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>

                <div class="main col-lg-4">
                    <div class="precio-producto">$ {{ $producto->precio }}</div>
                    <div>
                        <!-- Example split danger button -->
                        <div class="btn-group" style="">
                            <a href="{{ route('productos.edit', [$domain, $producto->id]) }}" class=" boton-default">Editar producto</a>
                            <button type="button" class=" boton-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" data-toggle="modal"  href="#modal-destroy{{ $producto->id }}">Eliminar</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
        </div><!--ROW-->
    </div><!--container-->

<div class="row">
  <div class="mx-auto">
    {{$productos->links()}}
  </div>
</div>

@endsection
