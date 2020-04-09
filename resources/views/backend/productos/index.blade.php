@extends('backend.layout')

@section('content')

<div class="container">
  <h2>Productos <a href="/admin/productos/create"><button class="addButton float-right"><i class="fas fa-plus" style="margin-right:10px"></i>Agregar nuevo producto</button></a></h2>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Imagen</th>
      <th scope="col">Nombre</th>
      <th scope="col">Precio</th>
      <th scope="col">Acción</th>
    </tr>
  </thead>
  <tbody>
    @foreach($productos as $producto)
    <tr>
      <th scope="row">{{$producto->id}}</th>
      <td><img src="{{asset('/images/azeda-images/zapatilla-ejemplo.jpg')}}" alt=""></td>
      <td>{{$producto->nombre}}</td>
      <td>{{$producto->precio}}</td>
      <td><a href="{{route('productos.edit', $producto->id)}}"><button class="btn btn-warning">Editar</button></a></td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>


@endsection