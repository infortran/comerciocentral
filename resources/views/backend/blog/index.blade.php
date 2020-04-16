@extends('backend.layout')

@section('content')
<div class="container">
	<h1>Editor del blog 
		<a href="{{url('admin/blog/create')}}">
		<button class="addButton float-right"><i class="fa fa-plus-square"></i> Nueva entrada</button></a></h1>

		
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
	<div class="container">
		@foreach($posts as $post)
		@include('backend.blog.modal-destroy')
		<div class="card mb-3"><!--card 1-->
			<div class="row no-gutters">
			    <div class="col-md-4">
			      <img src="{{asset('images/uploads/blog').'/'.$post->img}}" class="card-img" alt="...">
			    </div>
			    <div class="col-md-8">
			      <div class="card-body">
			      		<div class="row">
			      			<div class="col-7">
			      				<h5 class="card-title"><strong>{{$post->titulo}}</strong></h5>
			      				<br><br>
			      				<hr>
						        <p class="card-text block-ellipsis">{{$post->contenido}}</p>
						        
			      			</div>
			      			<div class="col-5">
			      				<button data-toggle="modal" data-target="#modal-destroy{{$post->id}}" style="margin-left: 10px" class="btn btn-danger float-right"><i class="fa fa-trash"></i> Eliminar</button>

								<a href="{{route('blog.edit', $post->id)}}">
						        <button class="btn btn-warning float-right"><i class="fa fa-edit"></i> Editar</button></a>
								<br><br>
						        <hr>
						        <p class="card-text"><small class="text-muted">Creado {{$post->created_at->diffForHumans()}}</small></p>
						        
						        <p  class="card-text"><small class="text-muted">Ultima actualizacion {{$post->updated_at->diffForHumans()}}</small></p>
			      			</div>
			      		</div>
			        

					
			      </div><!--.card-body-->
			    </div>
			  </div>
			</div><!--.card 1-->
			@endforeach
			{{$posts->links()}}
	</div>	
</div>
@endsection