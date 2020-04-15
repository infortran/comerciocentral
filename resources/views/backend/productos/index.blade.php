<!--BACKEND-->
<!--INDEX DEL PRODUCTO-->

@extends('backend.layout')

@section('content')



<div class="container">
  <h2>Productos <a href="/admin/productos/create"><button class="addButton float-right"><i class="fas fa-plus" style="margin-right:10px"></i>Agregar nuevo producto</button></a></h2>

  <!-- ============================
         MODALS ELIMINAR PRODUCTO
  ================================= -->
  @foreach($productos as $producto)
    @include('backend.productos.modal-destroy')
  @endforeach


  <!-- ============================
          FORMULARIO DE BUSQUEDA
  ================================= -->
  <div class="container" style="margin-top:50px">
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
          <input name="search" class="form-control form-control-navbar" type="search" placeholder="Busca un producto"
                            aria-label="Search">
          <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                 <i class="fas fa-search"></i>
              </button>
          </div>
      </div>
  </form>
  @if($search)
  <div class="alert alert-info">Resultados para tu busqueda <strong>"{{$search}}"</strong></div>
  @endif
  </div>
  <!---....FIN FORMULARIO BUSQUEDA.....-->




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
      <td><img style="width: 100%; max-width: 100px" src="{{ asset('/images/uploads/productos/'). '/' . $producto->img}}" alt=""></td>
      <td>{{$producto->nombre}}</td>
      <td>{{$producto->precio}}</td>
      <td><a href="{{route('productos.edit', $producto->id)}}"><button class="btn btn-warning"><i class="fas fa-edit"></i> Editar</button></a>
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