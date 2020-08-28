@extends('frontend.templates.principal')
@section('content')

<section>
		<div class="container">
            <h1 class="titulo-principal">Noticias y novedades</h1>
            <hr>
			<div class="row">
				<!--=============================
								ASIDE
				===============================-->
				@include('frontend.templates.aside-left-blog')
				<!--=============FIN ASIDE==================-->
				<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center" style="font-size: 25px">{{$post->titulo}}</h2>
						<div class="single-blog-post">
							<h3></h3>
							<div class="post-meta">
								<ul>

									<li><i class="fa fa-calendar"></i> {{$post->created_at->format('d/m/Y')}}</li>
									<li><i class="fa fa-clock"></i> {{$post->created_at->diffForHumans()}}</li>
								</ul>
							</div>
                            <div class="post-container">
                                <img src="{{asset('images/uploads/blog').'/'.$post->img}}" alt="">
                                <div class="text-post-contenido">
                                    {!! $post->contenido !!}
                                </div>

                            </div>


						</div>
					</div><!--/blog-post-area-->

					<div class="rating-area post-container flex">
						<ul class="ratings" style="flex:1">
							<li class="rate-this">Valoracion:</li>
                            <div class="stars blog-single-stars">


                                @if($post->ratings()->avg('voto') > 0.4 && $post->ratings()->avg('voto') < 1)
                                    <div class="media-estrella">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half"></i>
                                    </div>
                                @else
                                    <i class="fa fa-star" style="color:{{ $post->ratings()->avg('voto') >= 1 ? '#ffab00' : ''}}"></i>
                                @endif

                                @if($post->ratings()->avg('voto') > 1.4 && $post->ratings()->avg('voto') < 2)
                                    <div class="media-estrella">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half"></i>
                                    </div>
                                @else
                                    <i class="fa fa-star" style="color:{{ $post->ratings()->avg('voto') >= 2 ? '#ffab00' : ''}}"></i>
                                @endif

                                @if($post->ratings()->avg('voto') > 2.4 && $post->ratings()->avg('voto') < 3)
                                    <div class="media-estrella">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half"></i>
                                    </div>
                                @else
                                    <i class="fa fa-star" style="color:{{ $post->ratings()->avg('voto') >= 3 ? '#ffab00' : ''}}"></i>
                                @endif


                                @if($post->ratings()->avg('voto') > 3.4 && $post->ratings()->avg('voto') < 4)
                                    <div class="media-estrella">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half"></i>
                                    </div>
                                @else
                                    <i class="fa fa-star" style="color:{{ $post->ratings()->avg('voto') >= 4 ? '#ffab00' : ''}}"></i>
                                @endif
                                @if($post->ratings()->avg('voto') > 4.4 && $post->ratings()->avg('voto') < 5)
                                    <div class="media-estrella">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half"></i>
                                    </div>
                                @else
                                    <i class="fa fa-star" style="color:{{ $post->ratings()->avg('voto') >= 5 ? '#ffab00' : ''}}"></i>
                                @endif

                            </div>
							<li class="color">({{count($post->ratings)}} {{count($post->ratings) > 1?'votos':'voto'}})</li>
						</ul>
                        <div class="user-rating-container">

                            <input type="radio">
                            <input type="radio">
                            <input type="radio">
                            <input type="radio">
                            <input type="radio">
                        </div>
                        <div class="autor">
                            <img style="max-width: 50px;margin-right: 10px" class="media-object" src="{{asset('images/uploads/users').'/'.$post->user->img}}" alt="">
                            <div><strong>Autor: {{$post->user->name}} {{$post->user->lastname}}</strong></div>
                        </div>
					</div><!--/rating-area-->



                    <!--==================================================00
                                COMENTARIOS
                    ================================================-->
					<div class="response-area">
						<h2>Comentarios ({{$post->comentarios()->count()}})</h2>
                        <hr>
						<ul class="media-list">


                            @foreach($post->comentarios as $comentario)
                                @if(! $comentario->banned)
                                    <div class="comentario">
                                        <div class="img">
                                            <img src="{{asset('images/uploads/users').'/'.$post->user->img}}" alt="">
                                        </div>
                                        <div class="contenido">
                                            <div class="header">
                                                <div class="username">{{$comentario->user->name}}</div>
                                                &nbsp; - &nbsp;
                                                <div class="diff-for-humans"><small>{{$comentario->created_at->diffForHumans()}}</small></div>
                                            </div>

                                            <div class="content">{{$comentario->comentario}}</div>
                                            <hr style="padding:0;margin:0">
                                            <div class="foot">
                                                @if(Auth::check())
                                                    @if($comentario->user->id === Auth::user()->id)
                                                    <div class="actions">
                                                        <button><i class="fa fa-edit"></i>Editar</button>
                                                        <button><i class="fa fa-times"></i>Eliminar</button>
                                                    </div>
                                                    @endif
                                                @endif
                                                <div class="date">
                                                    <i class="fa fa-calendar"></i>
                                                    {{ $comentario->created_at->timezone('America/Santiago')->format('d/m/Y') }}
                                                    &nbsp; - &nbsp;
                                                    <i class="fa fa-clock"></i>
                                                    {{ $comentario->created_at->timezone('America/Santiago')->format('H:i') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                            @endforeach

						</ul>
					</div><!--/Response-area-->
                    <hr>
					<div class="replay-box">
						<div class="row">
							<form method="POST" action="{{url('comentario')}}" class="col-xs-12">
                                @csrf
								<h2>Déjanos tu comentario</h2>
                                <div class="replay-container">
                                    <img style="max-height: 70px;margin-right: 20px" src="{{ Auth::check() ? asset('images/uploads/users').'/'.Auth::user()->img : asset('images/system/avatar.png') }}" alt="">
                                    <textarea name="comentario" class="form-control" {{Auth::check() ? '':'disabled'}}></textarea>
                                </div>

                                <input name="id_user" type="hidden" value="{{Auth::check() ? Auth::user()->id : ''}}">
                                <input name="id_post" type="hidden" value="{{$post->id}}">

                                @guest
                                <a href="{{ url('/login') }}" class="btn btn-primary">Debes iniciar sesion</a>
                                @else
                                <button class="btn btn-primary" type="submit">Comentar</button>
                                @endif
							</form>
						</div>
					</div><!--/Repaly Box-->
				</div>
			</div>
		</div>
	</section>
	@endsection
