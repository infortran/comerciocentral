<!--BACKEND-->
<!--Vista editar producto-->

@extends('backend.layout')

@section('content')
<div class="container">
	<h2>Editar un producto </h2>
	<div class="container">
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
	</div>
	<div class="container">
		<form class="row" action="{{route('productos.update', $producto->id)}}" method="POST" enctype="multipart/form-data">
		<div class="col-md-6">
			
				@method('PATCH')
				@csrf
			  <div class="form-group">
			    <label for="nombre">Nombre del producto</label>
			    <input type="text" class="form-control" name="nombre" value="{{$producto->nombre}}">
			  </div>
			  <div class="form-group">
			    <label for="descripcion">Descripcion</label>
			    <input type="text" class="form-control" name="descripcion" value="{{$producto->descripcion}}" placeholder="Ingresa una descripcion del modelo como tallas disponibles, colores, variedades">
			  </div>

				<div class="form-group">
				    <label for="precio">Precio</label>
				    <div class="input-group mb-2">
				        <div class="input-group-prepend">
				        	<div class="input-group-text">$</div>
				        </div>
				        <input type="text" class="form-control" name="precio" value="{{$producto->precio}}" placeholder="0">
				    </div>
				</div>
			  
		</div>
		<div class="col-md-6">
			<div class="card" style="width: 25rem;">
			  
			  <img id="img-create-producto" class="card-img-top" src="{{asset('images/uploads/productos') .'/'.$producto->img}}" alt="Imagen producto">
			  <div class="card-body">
			    <h5 class="card-title">Subir una imagen</h5>
			    
			    	
			    	<input type="file" name="img" id="img-input-producto">
			    <!--button class="btn btn-primary" style="margin-top:5px" type="submit"><i class="fas fa-save"> </i> Subir</button-->
			    
			    
			  </div>
			</div>
		</div>
		<button type="submit" class="addButton">Aplicar cambios</button>
		</form>
	</div>

</div>
@endsection