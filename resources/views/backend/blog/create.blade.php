@extends('backend.layout')

@section('content')

<form class="container" action="/admin/blog" method="POST" enctype="multipart/form-data">
	@csrf
	<h1>Nueva entrada <button type="submit" class="addButton float-right"><i class="fa fa-save"></i> Guardar</button></h1>
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
		<div class="col-8">
			<div class="card">
				
				<div class="card-body">
					
						<div class="form-group">
						    <label for="">Titulo</label>
						    <input name="titulo" type="text" class="form-control">
						</div>
						<div class="form-group">
						    <label for="">Contenido</label>
						    <textarea name="contenido" class="form-control" style="min-height: 300px"></textarea>
						</div>
						
						
					
				</div>
			</div>
			
		</div>

		<div class="col-4">
			<div class="card">
				<img  src="{{asset('images/semantic/image.png')}} " alt="" class="card-img-top">
				<div class="card-body">
					<h2 class="card-title">Subir imagen a entrada</h2>
					<input name="img" type="file">

					<small>La imagen debe ser mayor de 1000x800 pixeles</small>
				</div><!---->
			</div><!---->
		</div><!---->
	</div><!--.row-->
</form><!--.container-->
@endsection