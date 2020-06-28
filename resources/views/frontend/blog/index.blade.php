@extends('frontend.templates.principal')
@section('content')
<section>

		<div class="container">
            <h1 class="titulo-principal">Noticias y novedades</h1>
            <hr>
			<div class="row">

				<!--=================================
							ASIDE
				=====================================-->
				@include('frontend.templates.aside-left')
				<!--===================FIN ASIDE=================-->

				<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">LO MAS RECIENTE</h2>
                        @foreach($posts as $post)
						<div class="single-blog-post">
							<h3>{{$post->titulo}}</h3>
							<div class="post-meta">
								<ul>
									<!--li><i class="fa fa-user"></i> Mac Doe</li>
									<li><i class="fa fa-clock-o"></i> 1:33 pm</li-->
									<li><i class="fa fa-calendar"></i> {{$post->created_at->diffForHumans()}}</li>
								</ul>
								<!--span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-o"></i>
								</span 847x392-->
							</div>
							<a href="">
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
			</div>
		</div>
	</section>


	@endsection
