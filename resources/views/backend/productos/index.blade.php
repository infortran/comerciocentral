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


  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Imagen</th>
      <th scope="col">Nombre</th>
      <th scope="col">Categoria</th>
      <th scope="col">Marca</th>
      <th scope="col">Precio</th>
        <th scope="col">Disponible</th>
      <th scope="col">Acción</th>
    </tr>
  </thead>
  <tbody>
    <?php use App\Categoria; use App\Marca; ?>
    @foreach($productos as $producto)

    <tr>
      <th scope="row">{{$producto->id}}</th>
      <td><img style="width: 100%; max-width: 100px" src="{{ asset('/images/uploads/productos/'). '/' . $producto->img}}" alt=""></td>
      <td>{{$producto->nombre}}</td>
      <td><?php echo ($categoria = Categoria::find($producto->id_categoria)) ? $categoria->categoria : 'Sin categoria'; ?></td>

      <td><?php echo ($marca = Marca::find($producto->id_marca)) ? $marca->marca : 'Sin marca'; ?></td>
      <td>$ {{$producto->precio}}</td>
        <td>
            @if($producto->is_available)
                {!! Form::open(['action' => ['ProductoController@setNotAvailable', $producto->id]]) !!}
                <label class="switch">
                    <input type="checkbox" checked onchange="this.form.submit()">
                    <span class="slider round"></span>
                </label>
                {!! Form::close() !!}
            @else
                {!! Form::open(['action' => ['ProductoController@setAvailable', $producto->id]]) !!}
                <label class="switch">
                    <input type="checkbox" onchange="this.form.submit()">
                    <span class="slider round"></span>
                </label>
                {!! Form::close() !!}
            @endif


        </td>
      <td><a href="{{route('productos.edit', ['domain' => $domain, $producto->id])}}"><button class="btn btn-warning"><i class="fas fa-edit"></i> Editar</button></a>
      <button class="btn btn-danger" style="padding:10px"  data-toggle="modal" data-target="#modal-destroy{{$producto->id}}"><i class="fas fa-minus-circle"></i></button>

      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
<div class="row">
  <div class="mx-auto">
    {{$productos->links()}}
  </div>
</div>

@endsection
