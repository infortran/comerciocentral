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
                            @foreach($slides as $key => $slide)
							<li data-target="#slider-carousel" data-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : ''}}"></li>
                            @endforeach
						</ol>

						<div class="carousel-inner">
                            @foreach($slides as $key => $slide)
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

	<section>
		<div class="container">
			<div class="row">

				<!--===========================================
									ASIDE
				=============================================-->
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
                        @foreach($productos as $producto)
                            @if($producto->is_available)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img style="max-width:255px;max-height: 192px" src="{{asset('images/uploads/productos').'/'.$producto->img}}" alt="" />
											<h2>${{$producto->precio}}</h2>
											<p>{{$producto->nombre}}</p>
											<button  id="btn-cart-2-{{$producto->id}}"  type="button" class="btn btn-default add-to-cart btn-submit-add-cart"  data-id="{{$producto->id}}">
                                                <i id="check-{{$producto->id}}"  class="fa fa-check" style="color: #72c400 !important;display: none"></i>
                                                <i id="icon-cart-{{$producto->id}}"  class="fa fa-shopping-cart"></i>
                                                <span id="btn-text-cart-{{$producto->id}}"  style="display: inline-block">Agregar al carrito</span>
                                            </button>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>$ {{$producto->precio}}</h2>
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
									<ul class="nav nav-pills nav-justified">
										<li><a href="{{route('producto.single', $producto->id)}}"><i class="fa fa-eye"></i>Ver detalles</a></li>
									</ul>
								</div>
							</div>
						</div>
                            @endif
                        @endforeach


					</div><!--FIN PRODUCTOS-->
                    {{$productos->links()}}




                    <!--=======================================0
                            PRODUCTOS POR MARCAS
                    ===========================================-->
					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
                                @foreach($marcas as $key => $marca)
                                    @if($marca->productos->count() > 0)
                                    <li class="{{$key == 0 ? 'active' : ''}}"><a href="#marca-tab-{{$marca->id}}" data-toggle="tab">{{$marca->marca}}</a></li>
                                    @endif
                                @endforeach
							</ul>
						</div>
						<div class="tab-content">
                            @foreach($marcas as $keym => $marca)
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




							<div class="tab-pane fade" id="poloshirt" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>

										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>

										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>

										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!--/category-tab-->



				</div><!--.col-9 content-->
			</div><!--.row-->
		</div>
	</section>

	@endsection
