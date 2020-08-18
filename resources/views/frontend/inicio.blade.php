@extends('frontend.templates.principal')

@section('content')
<!--=========================================-
			CARRUSEL
===============================================-->
	<section id="slider">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
                            @foreach($tienda->slides as $key => $slide)
							<li data-target="#slider-carousel" data-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : ''}}"></li>
                            @endforeach
						</ol>

						<div class="carousel-inner">
                            @foreach($tienda->slides as $key => $slide)
							<div class="item {{$key == 0 ? 'active' : ''}}">
								<div class="col-sm-6">
                                    <img src="{{asset('images/uploads/slides').'/'. $slide->logo}}" alt="">
									<h2>{{$slide->titulo}}</h2>
									<p>{{$slide->subtitulo}}</p>
                                    <a href="{{url('/producto').'/'.$slide->productos->id}}">	<button type="button" class="btn btn-default btn-slide get">{{$slide->txt_boton}}</button></a>
								</div>
								<div class="col-sm-6">
									<img src="{{asset('images/uploads/slides').'/'. $slide->img}}" class="girl img-responsive" alt="" />
									<img src="{{asset('images/uploads/slides').'/'. $slide->img_pricing}}"  class="pricing" alt="" />
								</div>
							</div>
                            @endforeach

						</div>

						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>

				</div>
			</div>
		</div>
	</section><!--====================/FIN CARRUSEL==============================-->


            <!--===========================================
					CERTIFICACION PUNTAJE Y DUEÑO
			=============================================-->
    <section>
        <div class="container">
            <div class="row evaluacion text-center">
                <div class="col-xs-12 col-lg-4 eval eval-certificacion">
                    <div class="icon-certificacion">
                        <svg class="icon-certificacion-svg" width="80" height="80">
                            <circle r="38" cx="40" cy="40" style="fill: {{ $certificacion ? '#68ca00' : 'yellow' }}"></circle>
                        </svg>
                        <i class="fa fa-store-alt store" style="color: {{ $certificacion ? 'white' : 'black' }}"></i>
                        <i class="fa fa-{{ $certificacion ? 'check' : 'times' }}-circle check" style="color:{{ $certificacion ? '#0f9500' :'red' }}"></i>
                    </div>

                    <div class="title">{{$certificacion ? 'Tienda Certificada' : 'Tienda No Certificada'}}</div>
                    <a href="{{ url('/certificaciones') }}">Ver detalles</a>
                </div>
                <div class="col-xs-12 col-lg-4 eval eval-puntuacion">
                    <div class="title">Puntuación</div>
                    <div class="points">{{ number_format($puntaje, 1) }}</div>
                    <div class="stars">
                        @if($puntaje > 0.4 && $puntaje < 1)
                            <div class="media-estrella">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half"></i>
                            </div>
                        @else
                            <i class="fa fa-star" style="color:{{ $puntaje >= 1 ? '#ffab00' : ''}}"></i>
                        @endif

                        @if($puntaje > 1.4 && $puntaje < 2)
                            <div class="media-estrella">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half"></i>
                            </div>
                        @else
                            <i class="fa fa-star" style="color:{{ $puntaje >= 2 ? '#ffab00' : ''}}"></i>
                        @endif

                            @if($puntaje > 2.4 && $puntaje < 3)
                                <div class="media-estrella">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half"></i>
                                </div>
                                @else
                                <i class="fa fa-star" style="color:{{ $puntaje >= 3 ? '#ffab00' : ''}}"></i>
                                @endif


                        @if($puntaje > 3.4 && $puntaje < 4)
                            <div class="media-estrella">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half"></i>
                            </div>
                        @else
                            <i class="fa fa-star" style="color:{{ $puntaje >= 4 ? '#ffab00' : ''}}"></i>
                        @endif
                            @if($puntaje > 4.4 && $puntaje < 5)
                                <div class="media-estrella">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half"></i>
                                </div>
                                @else
                                <i class="fa fa-star" style="color:{{ $puntaje >= 5 ? '#ffab00' : ''}}"></i>
                                @endif

                    </div>
                    <div class="users-votes">
                        <i class="fa fa-users"></i>
                        <strong>{{ count($tienda->ratings) }}</strong>
                        <div><small>votos</small></div>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-4 eval eval-owner">

                    <img style="max-height: 80px" class="img-responsive center-block" src="{{ asset('images/uploads/users'). '/'. $tienda->user->img }}" alt="">
                    <div class="owner-name">{{ $tienda->user->name. ' '. $tienda->user->lastname }}</div>
                    <div class="owner-position">Representante</div>
                </div>
            </div>
        </div>
    </section><!--====================/CERT PUNTAJE DUEÑO==============================-->



	<section>
		<div class="container">
			<div class="row">

				<!--===========================================
									ASIDE
				=============================================-->
                <!-- ============================
                         FORMULARIO DE BUSQUEDA
                    ================================= -->



				@include('frontend.templates.aside-left')
				<!--====================FIN ASIDE===========================-->


                <!--===========================================
                                 PRODUCTOS
                ================================================-->
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Nuestros productos</h2>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row prod-container" >

                            @if(count($productos) == 0)
                            <div class="producto-notfound col-lg-12">
                                <i class="fa fa-exclamation-triangle"></i>
                                <div>
                                    <div class="title">No hemos encontrado productos</div>
                                    <div><small>Prueba buscando con otros terminos de busqueda</small></div>
                                </div>
                            </div>
                            @endif
                            <div class="loading-productos display-none">
                                <div class="loading-icon">
                                    <i class="fa fa-circle-notch fa-spin"></i>
                                    <div>Buscando</div>
                                </div>
                            </div>
                        @foreach($productos as $producto)
                            @if($producto->is_available)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img style="height: 192px" src="{{asset('images/uploads/productos').'/'.$producto->img}}" alt="" />
											<h2>$ {{number_format($producto->precio, 0, '', '.')}}</h2>
											<p>{{$producto->nombre}}</p>
											<button  id="btn-cart-2-{{$producto->id}}"  type="button" class="btn btn-default add-to-cart btn-submit-add-cart"  data-id="{{$producto->id}}">
                                                <i id="check-{{$producto->id}}"  class="fa fa-check" style="color: #72c400 !important;display: none"></i>
                                                <i id="icon-cart-{{$producto->id}}"  class="fa fa-shopping-cart"></i>
                                                <span id="btn-text-cart-{{$producto->id}}"  style="display: inline-block">Agregar al carrito</span>
                                            </button>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>$ {{number_format($producto->precio, 0, '', '.')}}</h2>
												<p>{{$producto->nombre}}</p>
												<button id="btn-cart-{{$producto->id}}" type="button" class="btn btn-default add-to-cart btn-submit-add-cart" data-id="{{$producto->id}}" >
                                                    <i id="check1-{{$producto->id}}" class="fa fa-check" style="color: #72c400 !important;display: none"></i>
                                                    <i id="icon-cart1-{{$producto->id}}" class="fa fa-shopping-cart"></i>
                                                    <span id="btn-text-cart1-{{$producto->id}}" style="display: inline-block">Agregar al carrito</span>
                                                </button>
											</div>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified text-center" >
										<li><a href="{{route('producto.single', [$domain ,$producto->id])}}"><i class="fa fa-eye"></i>Ver detalles</a></li>
									</ul>
								</div>
							</div>
						</div>
                            @endif
                        @endforeach
                        </div>

					</div><!--FIN PRODUCTOS-->
                    {{ $productos->links() }}




                    <!--=======================================0
                            PRODUCTOS POR MARCAS
                    ===========================================->
					<div class="category-tab"><-category-tab->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
                                @foreach($tienda->marcas as $key => $marca)
                                    @if($marca->productos->count() > 0)
                                    <li class="{{$key == 0 ? 'active' : ''}}"><a href="#marca-tab-{{$marca->id}}" data-toggle="tab">{{$marca->marca}}</a></li>
                                    @endif
                                @endforeach
							</ul>
						</div>
						<div class="tab-content">
                            @foreach($tienda->marcas as $keym => $marca)
							<div class="tab-pane fade {{$keym == 0 ? 'active in' : ''}}" id="marca-tab-{{$marca->id}}" >
                                @foreach($marca->productos as $producto)
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img style="max-width:187px;max-height: 137px !important;" src="{{asset('images/uploads/productos').'/'.$producto->img}}" alt="" />
												<h2>{{$producto->precio}}</h2>
												<p>{{$producto->nombre}}</p>
												<button class="btn btn-default add-to-cart btn-submit-add-cart" data-id="{{$producto->id}}"><i class="fa fa-shopping-cart"></i>Agregar al carrito</button>
											</div>

										</div>
									</div>
								</div>
                                @endforeach


							</div>
                            @endforeach
						</div>
					</div><!--/category-tab-->



				</div><!--.col-9 content-->

			</div><!--.row-->
            <div class="recommended_items"><!--recommended_items-->
                <h2 class="title text-center">ultimas noticias</h2>
                        @foreach($tienda->posts->take(3) as $noticia)

                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ asset('images/uploads/blog').'/' .$noticia->img }}" alt="" />
                                            <div class="text-productinfo ">
                                                <h4>{{ $noticia->titulo }}</h4>
                                                <div class="cont-noticia" >{{ $noticia->contenido }}</div>
                                                <a href="{{route('post', [$domain, $noticia->id])}}">Ver mas</a>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            @endforeach
                    </div>
                </div>
            </div><!--/recommended_items-->
            <div class="row">
                <div class="banner">

                </div>
            </div>
		</div><!-- FIN CONTAINER-->
	</section>

	@endsection
