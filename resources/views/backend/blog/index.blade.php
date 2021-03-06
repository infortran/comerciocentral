@extends('backend.layout')

@section('content')
<div class="container">
	<h1>Editor del blog
		<a href="{{url('admin/blog/create')}}">
		<button class="btn btn-comerciocentral float-right"><i class="fa fa-pencil-alt"></i> Nueva noticia</button></a></h1>


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
		@if(count($posts) > 0)
		@foreach($posts as $post)
		@include('backend.blog.modal-destroy')
		<div class="card mb-3"><!--card 1-->
			<div class="row no-gutters">
			    <div class="col-md-4">
                    <a href="{{route('blog.show', ['domain' => $domain ,$post->id])}}">
                        <img src="{{asset('images/uploads/blog').'/'.$post->img}}" class="card-img" alt="...">
                    </a>
			    </div>
			    <div class="col-md-8">
			      <div class="card-body">
			      		<div class="row">
			      			<div class="col-7">
                                <a href="{{route('blog.show', ['domain' => $domain ,$post->id])}}"><h5 class="card-title"><strong>{{$post->titulo}}</strong></h5></a>
			      				<br>
			      				<hr>
						        <p class="card-text block-ellipsis">{{strip_tags(html_entity_decode($post->contenido))}}</p>

			      			</div>
			      			<div class="col-5">
			      				<button data-toggle="modal" data-target="#modal-destroy{{$post->id}}" style="margin-left: 10px" class="btn btn-danger float-right"><i class="fa fa-trash"></i> Eliminar</button>

								<a href="{{route('blog.edit', ['domain' => $domain ,$post->id])}}">
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
			@else
			<div class="row">
				<div class="col-12">
					<div class="no-posts">
						<div class="icon-container">
							<div class="icon"></div>
							<i class="fa fa-newspaper"></i>
						</div>
						<div class="title">Aun no has publicado tu primera noticia</div>
						<div>Te invitamos a publicar las nuevas noticias asociadas a tu tienda</div>
						<div class="btn-container">
							<a href="{{url('admin/blog/create')}}" class="btn btn-comerciocentral">
								<i class="fa fa-pencil-alt"></i>
								Nueva Noticia</a>
						</div>
					</div>
				</div>
			</div>
			@endif
	</div>
</div>
@endsection
