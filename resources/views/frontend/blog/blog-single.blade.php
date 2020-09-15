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
                                <img class="img-post" src="{{asset('images/uploads/blog').'/'.$post->img}}" alt="">
                                <div class="text-post-contenido">
                                    {!! $post->contenido !!}
                                </div>

                            </div>


						</div>
					</div><!--/blog-post-area-->

					<div class="rating-area rating-container flex">
						<ul class="ratings">
							<li class="rate-this">Valoracion:</li>
                            <div class="stars blog-single-stars">


                                @if($promedio > 0.4 && $promedio < 1)
                                    <div class="media-estrella">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half"></i>
                                    </div>
                                @else
                                    <i class="fa fa-star" style="color:{{ $promedio >= 1 ? '#ffab00' : ''}}"></i>
                                @endif

                                @if($promedio > 1.4 && $promedio < 2)
                                    <div class="media-estrella">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half"></i>
                                    </div>
                                @else
                                    <i class="fa fa-star" style="color:{{ $promedio >= 2 ? '#ffab00' : ''}}"></i>
                                @endif

                                @if($promedio > 2.4 && $promedio < 3)
                                    <div class="media-estrella">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half"></i>
                                    </div>
                                @else
                                    <i class="fa fa-star" style="color:{{ $promedio >= 3 ? '#ffab00' : ''}}"></i>
                                @endif


                                @if($promedio > 3.4 && $promedio < 4)
                                    <div class="media-estrella">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half"></i>
                                    </div>
                                @else
                                    <i class="fa fa-star" style="color:{{ $promedio >= 4 ? '#ffab00' : ''}}"></i>
                                @endif
                                @if($promedio > 4.4 && $promedio < 5)
                                    <div class="media-estrella">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half"></i>
                                    </div>
                                @else
                                    <i class="fa fa-star" style="color:{{ $promedio >= 5 ? '#ffab00' : ''}}"></i>
                                @endif

                            </div>
							<li class="color">({{count($post->postratings)}} {{count($post->postratings) > 1?'votos':'voto'}})</li>
						</ul>
                        <div class="user-rating-container text-center">
                            @if(Auth::check())

                            <div class="title">Tu voto</div>
                                @if(!$ha_votado)

                            <select id="star-rating-voto" data-post="{{$post->id}}">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                                @else
                                    <div class="stars blog-single-stars">
                                        <i class="fa fa-star fa-2x" style="color:{{ $promedio >= 1 ? '#ffab00' : ''}}"></i>
                                        <i class="fa fa-star fa-2x" style="color:{{ $promedio >= 2 ? '#ffab00' : ''}}"></i>
                                        <i class="fa fa-star fa-2x" style="color:{{ $promedio >= 3 ? '#ffab00' : ''}}"></i>
                                        <i class="fa fa-star fa-2x" style="color:{{ $promedio >= 4 ? '#ffab00' : ''}}"></i>
                                        <i class="fa fa-star fa-2x" style="color:{{ $promedio >= 5 ? '#ffab00' : ''}}"></i>
                                        </div>
                                    @endif
                            <div><small id="cant-voto">{{ $ha_votado ? 'Ya ha votado' : 'Aun no has votado' }}</small></div>
                            @endif
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
                        <div class="replay-box">
                            <div class="row">
                                <form method="POST" action="{{url('comentario')}}" class="col-xs-12">
                                    @csrf
                                    <h2 class="title-secondary">Déjanos tu comentario</h2>
                                    <div class="replay-container">
                                        <img class="hidden-xs" style="max-height: 70px;margin-right: 20px" src="{{ Auth::check() ? asset('images/uploads/users').'/'.Auth::user()->img : asset('images/system/avatar.png') }}" alt="">
                                        <textarea name="comentario" class="form-control" {{Auth::check() ? '':'disabled'}}></textarea>
                                    </div>

                                    <input name="id_user" type="hidden" value="{{Auth::check() ? Auth::user()->id : ''}}">
                                    <input name="id_post" type="hidden" value="{{$post->id}}">

                                    @guest
                                    <a href="{{ url('/login') }}" class="btn btn-primary pull-right">Debes iniciar sesion</a>
                                    @else
                                        <button class="btn btn-primary pull-right" type="submit">Comentar</button>
                                    @endif
                                </form>
                            </div>
                        </div><!--/Repaly Box-->
						<h2 class="title-secondary">Comentarios ({{$post->comentarios->count()}})</h2>
                        <hr>
						<ul class="media-list">


                            @foreach($post->comentarios as $comentariopost)

                                @if(! $comentariopost->comentario->banned)
                                    <div class="comentario">
                                        <div class="img">
                                            <img src="{{asset('images/uploads/users').'/'.$comentariopost->comentario->user->img}}" alt="">
                                        </div>
                                        <div class="contenido">
                                            <div class="header">
                                                <div class="img-xs">
                                                    <img src="{{asset('images/uploads/users').'/'.$comentariopost->comentario->user->img}}" alt="">
                                                </div>
                                                <div class="username">{{$comentariopost->comentario->user->name}}</div>
                                                &nbsp; - &nbsp;
                                                <div class="diff-for-humans"><small>{{$comentariopost->comentario->created_at->diffForHumans()}}</small></div>
                                            </div>

                                            <div class="content">{{$comentariopost->comentario->comentario}}</div>
                                            <hr style="padding:0;margin:0">
                                            <div class="foot">
                                                    @if(Auth::check() && $comentariopost->comentario->user->id === Auth::user()->id)
                                                    <div class="actions">
                                                        <button><i class="fa fa-edit"></i>Editar</button>
                                                        <button><i class="fa fa-times"></i>Eliminar</button>
                                                    </div>
                                                    @endif
                                                <div class="date">
                                                    <i class="fa fa-calendar"></i>
                                                    {{ $comentariopost->comentario->created_at->timezone('America/Santiago')->format('d/m/Y') }}
                                                    &nbsp; - &nbsp;
                                                    <i class="fa fa-clock"></i>
                                                    {{ $comentariopost->comentario->created_at->timezone('America/Santiago')->format('H:i') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                            @endforeach

						</ul>
					</div><!--/Response-area-->


				</div>
			</div>
		</div>
	</section>
	@endsection
