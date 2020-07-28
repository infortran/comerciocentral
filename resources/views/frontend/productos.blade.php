@extends('frontend.templates.principal')


@section('content')
<section style="margin-bottom: 100px">

    <div class="container">

        <div class="row" style="display: flex">
            <div class="col-xs-12 col-md-8 banner-main-productos">
                <div class="row">
                    <div class="col-xs-12 col-md-6 text-center center-block banner-main-a" style="background: linear-gradient(to right, {{ $tienda->productobanner->color_bg_a1 ?? '#cfcfcf'}}, {{ $tienda->productobanner->color_bg_a2 ?? '#ffffff'}});">

                        <img style="z-index: 2; position:relative; height:80px" src="{{asset('images/uploads/marcas').'/'. ($tienda->productobanner->img ?? 'logo.jpg')}}" alt="">
                        <div class="titulo-banner-main" style="color:{{ $tienda->productobanner->color_titulo ?? '#000000'}}">{{ $tienda->productobanner->titulo ?? 'Productos'}}</div>

                        <div class="text-banner-main" style="color:{{ $tienda->productobanner->color_texto ?? '#000000' }} !important">{{ $tienda->productobanner->txt1 ?? 'Antes $ 10990'}}</div>
                        <div class="subtitulo-banner-main" style="color:{{ $tienda->productobanner->color_texto ?? '#000000' }} !important">{{ $tienda->productobanner->txt2 ?? 'Ahora $ 9990'}}</div>
                        @if($tienda->productobanner->producto)
                        <a href="{{ url('producto').'/'. ($tienda->productobanner->producto->id ?? '') }}" class="btn btn-primary btn-banner-main">{{ $tienda->productobanner->btn ?? 'Comprar'}}</a>
                        @else
                            <button class="btn btn-primary btn-banner-main">Comprar</button>
                            @endif


                        <svg class="svg circle-a hidden-xs" height="210" width="100%">
                            <circle cx="50%" cy="-6%" r="70%"/>
                        </svg>

                        <svg class="svg circle-b hidden-sm hidden-md hidden-lg" height="100%" width="100%">
                            <circle cx="50%" cy="50%" r="50%"/>
                        </svg>
                        <svg class="svg circle-b hidden-sm hidden-md hidden-lg" height="100%" width="100%">
                            <circle cx="50%" cy="50%" r="60%"/>
                        </svg>

                        <svg class="svg circle-c hidden-xs" height="100%" width="100%">
                            <circle cx="50%" cy="20" r="70%"/>
                        </svg>

                    </div>
                    <div class="col-xs-12 col-md-6 banner-main-b" style="padding:0;background: linear-gradient(to right, {{ $tienda->productobanner->color_bg_b1 ?? '#cfcfcf'}}, {{ $tienda->productobanner->color_bg_b2 ?? '#ffffff'}});">
                        <div class="dscto-banner-main">
                            <span>{{ $tienda->productobanner->dscto ?? '10% DSCTO'}}</span>
                        </div>
                        <img class="center-block" src="{{asset('images/uploads/productos').'/'. ($tienda->productobanner->producto->img ?? 'image.png')}}" alt="">
                    </div>
                </div>
            </div>

            <div class="hidden-xs col-md-4 pull-right banner-secondary-productos">

                <div class="row banner-sec-a text-center"  style="background-image: url('{{ asset('images/uploads/productos').'/' }}')">
                    <div class="col-md-12">
                        <div class="titulo-banner-sec">
                            Producto
                        </div>
                        <div class="dscto-banner-sec">
                            <div class="row">
                                <div id="txt-porcent-dscto">40%</div>
                                <div style="font-size: 10px;">DESCUENTO</div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row banner-sec-b ">

                    <button class="btn btn-primary btn-banner-sec">Click me</button>
                </div>
            </div>

        </div>



        <div class="row" style="margin-top: 100px">
            <!--===========================================
                             ASIDE
            =============================================-->
            @include('frontend.templates.aside-left')
            <!--====================FIN ASIDE===========================-->

            <!--===========================================
                             PRODUCTOS
            ================================================-->

            @if($productos->count() > 0)
            <div class="col-sm-9 padding-right">
                @if(isset($search) && $search)
                    <div >
                        <div class="alert alert-info">Resultados para tu busqueda <strong>"{{$search}}"</strong></div>
                    </div>
                @endif
                <div class="features_items"><!--features_items-->

                    <h2 class="title text-center">Nuestros productos</h2>

                    <div class="row prod-container">
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
                                            <h2>$ {{$producto->precio}}</h2>
                                            <p class="cont-noticia">{{$producto->nombre}}</p>
                                            <button  id="btn-cart-2-{{$producto->id}}"  type="button" class="btn btn-default add-to-cart btn-submit-add-cart"  data-id="{{$producto->id}}">
                                                <i id="check-{{$producto->id}}"  class="fa fa-check" style="color: #72c400 !important;display: none"></i>
                                                <i id="icon-cart-{{$producto->id}}"  class="fa fa-shopping-cart"></i>
                                                <span id="btn-text-cart-{{$producto->id}}"  style="display: inline-block">Agregar al carrito</span>
                                            </button>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>$ {{$producto->precio}}</h2>
                                                <p class="cont-noticia">{{$producto->nombre}}</p>
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
                                            <li><a href="{{route('producto.single', [$domain, $producto->id])}}"><i class="fa fa-eye"></i>Ver detalles</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @endforeach
                    </div>


                </div><!--FIN PRODUCTOS-->
            {{ $productos->links() }}
            </div>
            @else
                <div class="col-sm-9">
                    <div class="alert alert-warning">
                        <h4>
                            <i class="fa fa-exclamation-circle"></i>
                            No se han encontrado productos
                        </h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
