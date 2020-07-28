@extends('backend.layout')

@section('content')
<form class="container" action="{{url('admin/productos')}}" enctype="multipart/form-data" method="POST">
	<h1>Agregar un producto <button type="submit" class="addButton float-right"><i class="fa fa-save"></i> Guardar</button></h1>
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
	<div style="margin-top: 20px" class="row">

		<div class="col-md-7">
			<div class="card">
				<div class="card-body">
					<div class="form-group">
					    <label for="nombre">Nombre del producto</label>
					    <input type="text" class="form-control" name="nombre" placeholder="Ingrese un nombre descriptivo">
				  	</div>
					<div class="form-group">
					    <label for="descripcion">Descripcion</label>
					    <textarea style="height: 100px" type="text" class="form-control" name="descripcion" placeholder="Ingresa una descripcion del modelo como tallas disponibles, colores, variedades"></textarea>
					</div>

					<div class="form-group">
						<label for="categoria">Categoria</label>
						<select class="form-control" style="width: 200px" name="categoria" id="categoria">
							@foreach($tienda->categorias as $categoria)
								<option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
							@endforeach


						</select>
					</div>

					<div class="form-group">
						<label for="categoria">Marca</label>
						<select class="form-control" style="width: 200px" name="marca" id="categoria">
							@foreach($tienda->marcas as $marca)
								<option value="{{$marca->id}}">{{$marca->marca}}</option>
							@endforeach


						</select>
					</div>

					<div class="form-group" style="width: 200px">
					      <label for="precio">Precio</label>
					      <div class="input-group mb-2">
					        <div class="input-group-prepend">
					          <div class="input-group-text">$</div>
					        </div>
					        <input type="text" class="form-control" name="precio" placeholder="0">
					      </div>
					    </div>
					</div>
				</div>

				@csrf

            <input type="hidden" name="tienda" value="{{ $tienda->id }}">


		</div>
		<div class="col-md-5">
			<div class="card">

			  <img id="img-create-producto" class="card-img-top" src="{{asset('images/semantic/image.png')}}" alt="Imagen producto">
			  <div class="card-body">
			    <h5 class="card-title">Subir una imagen</h5>


			    	<input type="file" name="img" id="img-input-producto">
			    <!--button class="btn btn-primary" style="margin-top:5px" type="submit"><i class="fas fa-save"> </i> Subir</button-->


			  </div>
			</div>

		</div>

	</div><!--.row-->

</form>
@endsection
