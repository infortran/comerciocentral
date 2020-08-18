@extends('frontend.templates.principal')
@section('content')
<section>

		<div class="container">
            <h1 class="titulo-principal">Blog de Noticias</h1>
            <hr>
			<div class="row">

				<!--=================================
							ASIDE
				=====================================-->
				@include('frontend.templates.aside-left-blog')
				<!--===================FIN ASIDE=================-->

				<div class="col-sm-6">
					<div class="blog-post-area">
						<h2 class="title text-center">LO MAS RECIENTE</h2>
                        @foreach($posts as $post)

						<div class="single-blog-post">
							<h3>{{$post->titulo}}</h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i>{{ $post->user->name.' '.$post->user->lastname }}</li>
									<li><i class="fa fa-clock"></i>{{ $post->created_at->format('H:i') }}</li>
									<li><i class="fa fa-calendar"></i> {{$post->created_at->diffForHumans()}}</li>
								</ul>
                                <div class="stars blog-stars">


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
								<!--span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half"></i>
								</span-->
							</div>
							<a href="{{url('noticias/post'.'/'.$post->id)}}">
								<img src="{{asset('images/uploads/blog').'/'.$post->img}}" alt="">
							</a>
							<p class="block-ellipsis">{{$post->contenido}}</p>
							<a  class="btn btn-primary" href="{{route('post', [$domain, $post->id])}}">Leer mas</a>
						</div>
                            <hr>
                        @endforeach





						<!--div class="pagination-area">
							<ul class="pagination">
								<li><a href="" class="active">1</a></li>
								<li><a href="">2</a></li>
								<li><a href="">3</a></li>
								<li><a href=""><i class="fa fa-angle-double-right"></i></a></li>
							</ul>
						</div-->
					</div>
				</div>

                <!--=================================
							ASIDE right
				=====================================-->
            @include('frontend.templates.aside-right-blog')
            <!--===================FIN ASIDE=================-->
			</div>
            {{ $posts->links() }}
		</div>
	</section>


	@endsection
