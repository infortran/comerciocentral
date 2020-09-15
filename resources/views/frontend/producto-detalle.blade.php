@extends('frontend.templates.principal')

@section('content')
<section style="margin-bottom: 50px">
		<div class="container">
			<div class="row">

				<!--===========================================
									ASIDE
				=============================================-->
				@include('frontend.templates.aside-left-blog')
				<!--=============FIN ASIDE================-->

				<div class="col-sm-9">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-7">
							<div class="view-product">
								<div class="oferta d-none-important">
									<div class="cantidad">50 %</div>
									<div class="text">descuento</div>
								</div>
								<div class="oferta d-none-important">
									<div class="text-oferta">OFERTA</div>
								</div>
								<img  style="max-height: 400px"  src="{{asset('images/uploads/productos').'/'.$producto->img}}" alt="" />

							</div>


						</div>
						<div class="col-sm-5">
							<div class="product-information"><!--/product-information-->
								<h2>{{$producto->nombre}}</h2>
								<p>{{$producto->descripcion}}</p>
                                <div style="font-size: 25px;">

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
								<span>
									<div class="antes">$ 2.000</div>
									<span>$ {{number_format($producto->precio, 0, '','.')}}</span>
									<label>Cantidad:</label>
									<input type="text" value="{{ Session::has('cart') && isset(Session::get('cart')->items[$producto->id]) ? Session::get('cart')->items[$producto->id]['cantidad'] : '0' }}" id="input-cantidad-producto-{{$producto->id}}"/>
                                    <hr>
                                    <button  id="btn-cart-2-{{$producto->id}}"  type="button" class="btn btn-default add-to-cart btn-submit-add-cart"  data-id="{{$producto->id}}" {{$producto->is_available ? '':'disabled'}}>
                                            <i id="check-{{$producto->id}}"  class="fa fa-check" style="color: #72c400 !important;display: none"></i>
                                            <i id="icon-cart-{{$producto->id}}"  class="fa fa-shopping-cart"></i>
                                            <i class="btn-cart-text" id="btn-text-cart-{{$producto->id}}">Agregar al carrito</i>
											<i class="btn-cart-text-xs" id="btn-text-cart-{{$producto->id}}">Agregar</i>
                                    </button>

                                    <button style="min-width: 50px" type="button" class="btn add-to-cart btn-default btn-submit-remove-on-cart" title="Quitar 1 item"  data-id="{{$producto->id}}" {{$producto->is_available ? '':'disabled'}}
                                    {{Session::has($cartname) && isset(Session::get($cartname)->items[$producto->id]) && Session::get($cartname)->items[$producto->id] > 0 ? '' : 'disabled'}}>
                                        <i class="fa fa-trash"></i>
                                    </button>

								</span>
								<p><b>Stock:</b>
                                @if($producto->is_available)
                                    <i class="badge" style="background: #69c700">Disponible</i>
                                @else
                                    <i class="badge" style="background: #ff5858">Agotado</i>
                                @endif
                                </p>
								<!--p><b>Condition:</b> New</p-->
								<p><b>Marca:</b> {{$producto->marca->marca}}</p>

							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					<div id="comentario-header" class="title-secondary text-center">Comentarios del producto</div>

					@if(count($producto->comentarios) > 0)
						@foreach($producto->comentarios as $comentarioprod)
					<form action="{{route('comentario.producto.update',[$domain, $comentarioprod->comentario->id])}}" method="POST" class="comentario">
						@csrf
						@method('PUT')
						<div class="img">
							<img src="{{asset('images/uploads/users').'/'.$comentarioprod->comentario->user->img}}" alt="">
						</div>
						<div class="contenido">
							<div class="header">
								<div class="img-xs">
									<img src="{{asset('images/uploads/users').'/'.$comentarioprod->comentario->user->img}}" alt="">
								</div>
								<div class="username">{{$comentarioprod->comentario->user->name.' '.$comentarioprod->comentario->user->lastname}}</div>
								&nbsp; - &nbsp;
								<div class="diff-for-humans"><small>{{$comentarioprod->comentario->created_at->diffForHumans()}}</small></div>
							</div>

							<div id="comentario-producto-cont-{{$comentarioprod->id}}" class="content">{{$comentarioprod->comentario->comentario}}</div>
							<textarea name="comentario" id="input-editar-comentario-producto-{{$comentarioprod->id}}" class="d-none form-control" rows="3"></textarea>
							<hr style="padding:0;margin:0">
							<div class="foot">

									@if(Auth::check() && $comentarioprod->comentario->user->id === Auth::user()->id)
										<div class="actions">
											<button class="btn-editar-comentario-producto" data-comentario="{{$comentarioprod->id}}"><i class="fa fa-edit"></i> Editar</button>
											<button class="d-none" id="btn-submit-comentario-producto-{{$comentarioprod->id}}" type="submit"><i class="fa fa-save"></i> Guardar</button>
											<button data-toggle="modal" data-target="#modal-delete-comentario-{{$comentarioprod->id}}"><i class="fa fa-trash"></i> Eliminar</button>
										</div>
									@endif

								<div class="date">
									<i class="fa fa-calendar"></i>

									{{ $comentarioprod->comentario->created_at->timezone('America/Santiago')->format('d/m/Y') }}
									&nbsp; - &nbsp;
									<i class="fa fa-clock"></i>

									{{ $comentarioprod->comentario->created_at->timezone('America/Santiago')->format('H:i') }}
								</div>
							</div>
						</div>
					</form>
						@endforeach
					@else
							<div class="no-comentario">
								<div class="icon-container">
									<div class="icon"></div>
									<i class="fa fa-comment-dots"></i>
								</div>
								<div class="text-container">
									<div class="title">
										Este producto aun no recibe comentarios
									</div>
									<div class="text">
										Una vez que hayas comprado este producto podrás dar tu opinion.
									</div>
									<button  id="btn-cart-2-{{$producto->id}}"  type="button" class="btn btn-default add-to-cart btn-submit-add-cart"  data-id="{{$producto->id}}" {{$producto->is_available ? '':'disabled'}}>
										<i id="check-{{$producto->id}}"  class="fa fa-check" style="color: #72c400 !important;display: none"></i>
										<i id="icon-cart-{{$producto->id}}"  class="fa fa-shopping-cart"></i>
										<i class="btn-cart-text" id="btn-text-cart-{{$producto->id}}">Agregar al carrito</i>
										<i class="btn-cart-text-xs" id="btn-text-cart-{{$producto->id}}">Agregar</i>
									</button>
								</div>
							</div>
					@endif




				</div>
			</div>
		</div>
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

@if(count($producto->comentarios) > 0)
	@foreach($producto->comentarios as $productocomentario)
		@include('frontend.templates.modals.modal-delete-comentario')
	@endforeach
@endif
	@endsection
