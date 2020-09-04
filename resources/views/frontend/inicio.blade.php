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
					REDUCTORES DE RIESGO
			=============================================-->
    <section>
        <div class="container">
            <div class="row reduct-container">
                <div class="reduct-a">
                    <div class="reduct">
                        <div class="icon-container">
                            <div class="icon"></div>
                            <i class="fa fa-head-side-mask covid-19"></i>
                        </div>
                        <div class="text-container">
                            <div class="title">Medidas COVID-19</div>
                            <div class="text">Tomamos todas las precauciones necesarias.</div>
                            <div><a href="">Conoce mas</a></div>
                        </div>
                    </div>

                    <div class=" reduct">
                        <div class="icon-container">
                            <div class="icon"></div>
                            <i class="fa fa-store"></i>
                        </div>
                        <div class="text-container">
                            <div class="title">Ubicacion fisica</div>
                            <div class="text">Contamos con un lugar donde nos puedes visitar</div>
                            <div><a href="">Conoce nuestra dirección</a></div>
                        </div>
                    </div>
                </div>
                <div class="reduct-b">
                    <div class=" reduct">
                        <div class="icon-container">
                            <div class="icon"></div>
                            <i class="fa fa-shipping-fast"></i>
                        </div>
                        <div class="text-container">
                            <div class="title">Despacho a domicilio</div>
                            <div class="text">Entrega en tu hogar, de manera segura y confiable.</div>
                            <div><a href="">Conoce nuestro delivery</a></div>
                        </div>
                    </div>
                    <div class=" reduct">
                        <div class="icon-container">
                            <div class="icon"></div>
                            <i class="fa fa-hand-holding-usd"></i>
                        </div>
                        <div class="text-container">
                            <div class="title">Compra protegida</div>
                            <div class="text">Tu dinero estara protegido durante la compra</div>
                            <div><a href="">Conoce mas</a></div>
                        </div>
                    </div>
                </div>


            </div>



        </div>
    </section><!--====================/CERT PUNTAJE DUEÑO==============================-->



	<section style="margin-top: 40px">
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

            </div><!--/recommended_items-->

		</div><!-- FIN CONTAINER-->
	</section>
    <div class="container-fluid banner-inferior-container">
        <div class="banner-inferior">
            <div class="img-container">
                <img src="{{asset('images/system/navbar-new2.png')}}" alt="">
            </div>
            <div class="text-container">
                <div class="title">
                    Comercio Central
                </div>
                <div class="text">
                    El centro del comercio electronico, donde puedes vender tus productos
                    en una elegante tienda virtual
                </div>
                <button class="btn-banner">Crea tu tienda ahora</button>
            </div>
        </div>
    </div>

	@endsection
