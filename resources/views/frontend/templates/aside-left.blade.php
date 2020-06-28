<div class="col-sm-3">
					<div class="left-sidebar">
						<h2 class="title">Categorias</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->


							@foreach($categorias as $categoria)
							<div class="panel panel-default">
								<form action="{{url('productos')}}" class="panel-heading" id="form_categoria{{$categoria->id}}">
                                    <input name="search" type="hidden" value="{{strtolower($categoria->categoria)}}">
                                    <input name="categoria" type="hidden" value="{{$categoria->id}}">
									<h4 class="panel-title"><a href="#" onclick="document.getElementById('form_categoria{{$categoria->id}}').submit();">{{$categoria->categoria}}</a></h4>
								</form>
							</div>
							@endforeach


						</div><!--/category-products-->

						<div class="brands_products"><!--brands_products-->
							<h2 class="title">Marcas</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
                                    <?php use App\Producto; ?>
									@foreach($marcas as $marca)
                                    <form action="{{url('/productos')}}" style="margin-top: 10px" id="form-marca-{{$marca->id}}">
                                        <input name="search" type="hidden" value="{{$marca->marca}}">
                                        <input name="marca" type="hidden" value="{{$marca->id}}">
									<li>
                                        <a href="#"onclick="document.getElementById('form-marca-{{$marca->id}}').submit();">
                                            <span class="pull-right">({{Producto::where('id_marca', $marca->id)->count()}})</span>
                                            {{$marca->marca}}
                                        </a>
                                    </li>
                                    </form>
									@endforeach
								</ul>
							</div>
						</div><!--/brands_products-->

						<div class="price-range"><!--price-range-->
							<h2 class="title">Rango de precios</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
                        @isset($banner_aside)
						<div class="shipping text-center banner-aside"><!--shipping-->
							<div class="row banner-aside-a"  style="background-image: url('{{ asset('images/uploads/productos').'/'.$banner_aside->productos->img }}')">
                                <div class="dscto-banner-aside">
                                    {{ $banner_aside->dscto }}
                                </div>

                            </div>
                            <div class="row banner-aside-b">
                                <svg class="content-banner-aside-b" width="100%" height="100px">
                                    <defs>
                                        <linearGradient id="gradBannerAside" x1="0%" y1="0%" x2="100%" y2="0%">
                                            <stop offset="0%" style="stop-color:{{ $banner_aside->color_a1 }};stop-opacity:1" />
                                            <stop offset="100%" style="stop-color:{{ $banner_aside->color_a2 }};stop-opacity:1" />
                                        </linearGradient>
                                    </defs>
                                    <rect width="100%" height="100px" style="fill: url(#gradBannerAside)"></rect>
                                </svg>
                                <button class="btn btn-primary btn-banner-aside">{{$banner_aside->txt_btn}}</button>
                            </div>
						</div><!--/shipping-->
                        @endisset
					</div>
				</div>
