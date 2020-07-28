<div class="col-sm-3">


					<div class="left-sidebar">
                        <div style="margin-top: 20px">
                            <form class="search-form" action="{{ url('/productos') }}">
                                <input name="search" type="text" class="textbox" placeholder="Buscar" required>
                                <button title="Search" value="" type="submit" class="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <hr>
						<h2 class="title">Categorias</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->


							@foreach($tienda->categorias as $categoria)
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

									@foreach($tienda->marcas as $marca)
                                    <form action="{{url('/productos')}}" style="margin-top: 10px" id="form-marca-{{$marca->id}}">
                                        <input name="search" type="hidden" value="{{$marca->marca}}">
                                        <input name="marca" type="hidden" value="{{$marca->id}}">
									<li>
                                        <a href="#"onclick="document.getElementById('form-marca-{{$marca->id}}').submit();">
                                            <span class="pull-right">({{$marca->productos()->count()}})</span>
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

								 <input type="text" class="span2" value="" data-slider-min="{{ $tienda->productos()->min('precio') }}" data-slider-max="{{ $tienda->productos()->max('precio') }}" data-slider-step="100" data-slider-value="[{{ $tienda->productos()->min('precio') }},{{ $tienda->productos()->max('precio') }}]" id="sl2" ><br />
								 <b class="pull-left min-precio">$ {{ number_format($tienda->productos()->min('precio'),0,'','.') }}</b> <b class="pull-right max-precio">$ {{ number_format($tienda->productos()->max('precio'),0,'','.') }}</b>
							</div>
						</div><!--/price-range-->

						<div class="shipping text-center banner-aside" style="background: linear-gradient(to bottom, {{ $tienda->asidebanner->color_princ_a ?? '' }}, {{ $tienda->asidebanner->color_princ_b ?? ''}});"><!--shipping-->
							<div class="row banner-aside-a"  style="background-image: url('{{ asset('images/uploads/productos').'/'.($tienda->asidebanner->producto->img ?? '')}}')">
                                <div class="dscto-banner-aside">
                                    {{ $tienda->asidebanner->dscto ?? ''}}
                                </div>

                            </div>
                            <div class="row banner-aside-b">
                                <svg class="svg content-banner-aside-b" width="100%" height="100px">
                                    <defs>
                                        <linearGradient id="gradBannerAside" x1="0%" y1="0%" x2="100%" y2="0%">
                                            <stop offset="0%" style="stop-color:{{ $tienda->asidebanner->color_sec_a ?? ''}};stop-opacity:1" />
                                            <stop offset="100%" style="stop-color:{{ $tienda->asidebanner->color_sec_b ?? ''}};stop-opacity:1" />
                                        </linearGradient>
                                    </defs>
                                    <rect width="100%" height="100px" style="fill: url(#gradBannerAside)"></rect>
                                </svg>
                                <a href="{{ url('producto').'/'. ($tienda->asidebanner->producto->id ?? '')}}" class="btn btn-primary btn-banner-aside">{{$tienda->asidebanner->btn ?? ''}}</a>
                            </div>
						</div><!--/shipping-->

					</div>
				</div>
