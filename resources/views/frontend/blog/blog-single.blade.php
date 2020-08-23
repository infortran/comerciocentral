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
                                <p>{{$post->contenido}}</p>
                            </div>


						</div>
					</div><!--/blog-post-area-->

					<div class="rating-area post-container" style="padding:5px;margin-top: 20px">
						<ul class="ratings">
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
							<!--li>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</li-->
							<li class="color">({{count($post->ratings)}} {{count($post->ratings) > 1?'votos':'voto'}})</li>
						</ul>
                        <div class="autor pull-right">
                            <a class="pull-left" href="#">
                                <img style="max-width: 50px" class="media-object" src="{{asset('images/uploads/users').'/'.$post->user->img}}" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Autor: {{$post->user->name}} {{$post->user->lastname}}</h4>
                            </div>
                        </div>
						<!--ul class="tag">
							<li>TAG:</li>
							<li><a class="color" href="">Pink <span>/</span></a></li>
							<li><a class="color" href="">T-Shirt <span>/</span></a></li>
							<li><a class="color" href="">Girls</a></li>
						</ul-->
					</div><!--/rating-area-->

					<!--div class="socials-share">
						<a href=""><img src="{{asset('images/blog/socials.png')}}" alt=""></a>
					</div><!--/socials-share-->


                    <!--================================
                                   AUTOR
                    ====================================-->
					<!--/AUTOR-->


                    <!--==================================================00
                                COMENTARIOS
                    ================================================-->
					<div class="response-area">
						<h2>Comentarios ({{$post->comentarios()->count()}})</h2>
						<ul class="media-list">


                            @foreach($post->comentarios as $comentario)
                                @if($comentario->banned)
                                    <li class="media">
                                        <a class="pull-left" href="#">
                                            <i class="fa fa-times fa-5x" style="color: red"></i>
                                        </a>
                                        <div class="media-body">
                                            <strong>Este comentario ha sido bloqueado por el administrador</strong>
                                            <p>El usuario no ha respetado las <a href="#">Normas de la comunidad</a></p>
                                        </div>
                                    </li>
                                @else
							<li class="media">

								<a class="pull-left" href="#">
									<img style="max-width: 150px; min-height: 150px" class="media-object " src="{{asset('images/uploads/users').'/'.$post->user->img}}" alt="">
								</a>
								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i>{{$comentario->user->name}}</li>
										<li><i class="fa fa-clock"></i>{{$comentario->created_at->timezone('America/Santiago')->format('H:i')}}</li>
										<li><i class="fa fa-calendar"></i>{{$comentario->created_at->timezone('America/Santiago')->format('d.m.Y')}}</li>
                                        <li><i class="fa fa-calendar"></i>{{$comentario->created_at->diffForHumans()}}</li>
									</ul>
									<p>{{$comentario->comentario}}</p>
									<!--a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a-->
								</div>
							</li>
                                    @endif
                            @endforeach
							<!--li class="media second-media">
								<a class="pull-left" href="#">
									<img class="media-object" src="{{asset('images/blog/man-three.jpg')}}" alt="">
								</a>
								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i>Janis Gallagher</li>
										<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
										<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
									<a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
								</div>
							</li-->

						</ul>
					</div><!--/Response-area-->
					<div class="replay-box">
						<div class="row">
							<form method="POST" action="{{url('comentario')}}" class="col-12">
                                @csrf
								<h2>Déjanos tu comentario</h2>
                                @guest
                                <div class="blank-arrow">
                                    <label>Debes iniciar sesion</label>
                                </div>
                                @endif
                                <textarea name="comentario" class="form-control"></textarea>
                                <input name="id_user" type="hidden" value="{{Auth::user() ? Auth::user()->id : ''}}">
                                <input name="id_post" type="hidden" value="{{$post->id}}">

                                @guest
                                <a href="{{ url('/login') }}" class="btn btn-primary">Debes iniciar sesion</a>
                                @else
                                <button class="btn btn-primary" type="submit">Comentar</button>
                                @endif
							</form>
							<!--div class="col-sm-8">
								<div class="text-area">
									<div class="blank-arrow">
										<label>Your Name</label>
									</div>
									<span>*</span>
									<textarea name="message" rows="11"></textarea>
									<a class="btn btn-primary" href="">post comment</a>
								</div>
							</div-->
						</div>
					</div><!--/Repaly Box-->
				</div>
			</div>
		</div>
	</section>
	@endsection
