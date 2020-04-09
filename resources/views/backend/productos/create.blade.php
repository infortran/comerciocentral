@extends('backend.layout')

@section('content')
<div class="container">
	<h2>Agregar un producto </h2>
	<div class="row">
		<div class="col-md-6">
			<form action="/productos" method="POST">
				@csrf
			  <div class="form-group">
			    <label for="nombre">Nombre del producto</label>
			    <input type="text" class="form-control" name="nombre" placeholder="Ingrese un nombre descriptivo">
			  </div>
			  <div class="form-group">
			    <label for="descripcion">Descripcion</label>
			    <input type="text" class="form-control" name="descripcion" placeholder="Ingresa una descripcion del modelo como tallas disponibles, colores, variedades">
			  </div>

				<div class="form-group">
				      <label for="precio">Precio</label>
				      <div class="input-group mb-2">
				        <div class="input-group-prepend">
				          <div class="input-group-text">$</div>
				        </div>
				        <input type="text" class="form-control" name="precio" placeholder="0">
				      </div>
				    </div>
			  <button type="submit" class="addButton">Guardar</button>
			  
			</form>
		</div>
	</div>

</div>
@endsection