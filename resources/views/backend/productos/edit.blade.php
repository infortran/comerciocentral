<!--BACKEND-->
<!--Vista editar producto-->

@extends('backend.layout')

@section('content')
<form class="container"  action="{{route('productos.update', $producto->id)}}" method="POST" enctype="multipart/form-data">
	<h2>Editar un producto </h2>
	<div class="row">
		<div class="col-6">
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
		
	</div>
	<div class="row">
		
		
		<div class="col-md-7">
			<div class="card">
				<div class="card-body">
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
						<label for="categoria">Categoria</label>
						<select class="form-control" style="width: 200px" name="categoria" id="categoria">
							@foreach($categorias as $categoria)
								<option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
							@endforeach


						</select>
					</div>

					<div class="form-group">
						<label for="categoria">Marca</label>
						<select class="form-control" style="width: 200px" name="marca" id="categoria">
							@foreach($marcas as $marca)
								<option value="{{$marca->id}}">{{$marca->marca}}</option>
							@endforeach


						</select>
					</div>

					<div class="form-group" style="width:200px">
					    <label for="precio">Precio</label>
					    <div class="input-group mb-2">
					        <div class="input-group-prepend">
					        	<div class="input-group-text">$</div>
					        </div>
					        <input type="text" class="form-control" name="precio" value="{{$producto->precio}}" placeholder="0">
					    </div>
					</div>


				</div>
			</div>
			
				
			  
		</div>
		<div class="col-md-5">
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
		
	</div>

</form>
@endsection