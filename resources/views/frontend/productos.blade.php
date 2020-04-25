@extends('frontend.templates.principal')


@section('content')
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
            @if($productos->count() > 0)
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Nuestros productos</h2>
                    @foreach($productos as $producto)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img style="max-height: 192px" src="{{asset('images/uploads/productos').'/'.$producto->img}}" alt="" />
                                        <h2>${{$producto->precio}}</h2>
                                        <p>{{$producto->nombre}}</p>
                                        <a onclick="snackbarAddCart()" href="{{route('cart.addtocart', ['id' => $producto->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>$ {{$producto->precio}}</h2>
                                            <p>{{$producto->nombre}}</p>
                                            <a onclick="snackbarAddCart()" href="{{route('cart.addtocart', ['id' => $producto->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
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
                    @endforeach


                </div><!--FIN PRODUCTOS-->
                {{$productos->links()}}
            </div>
            @elseif($search)
                <div class="col-sm-9">
                    <div class="alert alert-warning">
                        <h4>
                            <i class="fa fa-exclamation-circle"></i>
                            No se han encontrado productos con el término: "{{$search}}"
                        </h4>
                    </div>
                </div>
                @endif
        </div>
    </div>
</section>
@endsection
