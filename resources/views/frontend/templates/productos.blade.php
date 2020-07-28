<div class="loading-productos display-none">
    <div class="loading-icon">
        <i class="fa fa-circle-notch fa-spin"></i>
        <div>Buscando</div>
    </div>
</div>

@if(count($productos)==0)
    <div class="producto-notfound col-lg-12">
        <i class="fa fa-exclamation-triangle"></i>
        <div>
            <div class="title">No hemos encontrado productos</div>
            <div><small>Prueba buscando con otros terminos de busqueda</small></div>
        </div>
    </div>
    @endif

@foreach($productos as $producto)
    @if($producto->is_available)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img style="max-width:255px;height: 192px" src="{{asset('images/uploads/productos').'/'.$producto->img}}" alt="" />
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
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="{{route('producto.single', [$domain ,$producto->id])}}"><i class="fa fa-eye"></i>Ver detalles</a></li>
                    </ul>
                </div>
            </div>
        </div>
    @endif
@endforeach
