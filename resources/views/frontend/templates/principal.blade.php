<!--HOME USER PLANTILLA HEADER Y FOOTER-->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Freddy Perez Pacheco">
    <title>{{ url()->current() === url('/')? 'Inicio': ucfirst(Request::segment(1)) }} | {{ $tienda->nombre }}</title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/all.css')}}" rel="stylesheet">
    <link href="{{asset('css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <style>
        :root{

            --color-primary: {{ $tienda->colortheme->primario ?? '#ffb401' }};
            --color-secondary: {{ $tienda->colortheme->secundario ?? '#f0f0f0' }};
            --color-background: {{ $tienda->colortheme->background ?? '#ffffff' }};
            --color-texto: {{ $tienda->colortheme->texto ?? '#000000' }};
            --color-texto-claro: {{ $tienda->colortheme->texto_claro ?? '#cfcfcf' }};
            --color-texto-btn: {{ $tienda->colortheme->texto_btn ?? '#ffffff' }};

        }
    </style>
	<link href="{{asset('css/main.min.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('css/bootstrap-stars.css')}}">
	<link href="{{asset('css/responsive.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="{{asset('js/html5shiv.js')}}"></script>
    <script src="{{asset('js/respond.min.js')}}"></script>
    <![endif]-->

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="tienda-id" content="{{ $tienda->id }}" >
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head><!--/head-->

<body>

<div class="snackbar" id="snackbar">Producto añadido al carrito</div>

<div class="snackbar" id="snackbar-remove">Producto eliminado</div>

<div class="snackbar" id="snackbar-reset">Producto eliminado del carrito</div>

	<header id="header"><!--header-->

        <!--=====================
            BARRA DE ADMINISTRACION (lo mas probable que la termine quitando)
       ===============================-->
		@if(Auth::check() && Auth::user()->role=='admin')

		<!--div class="header_top" style="background: #afafaf">
			<div class="container">
				<div class="row">

					<a class="pull-right" href="" onclick="event.preventDefault();
                    document.getElementById('logout-form-nav').submit();">
                    	<button style="margin: 10px" class="btn btn-warning">Salir</button>
                    </a>
                    <form id="logout-form-nav" action="" method="POST"
                        style="display: none;">
                        @csrf
                    </form>

					<a class="pull-right" href="{{url('/admin')}}"><button style="margin: 10px" class="btn btn-default">Administracion</button></a>


				</div>
			</div>
		</div-->
		@endif<!--FIN BARRA ADMIN-->


        <!--=====================================
                    PRIMERA BARRA NAVBAR (sociales, telefono y email)
        ==========================================-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-10 text-center">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="{{url('/contacto')}}"><i class="fa fa-phone"></i> {{$tienda->telefono}}</a></li>
								<li><a href="{{url('/contacto')}}"><i class="fa fa-envelope"></i> {{$tienda->email}}</a></li>
							</ul>
						</div>
					</div>
					<div class="col-xs-12 col-md-2 text-center">
						<div class="social-icons">
							<ul class="nav navbar-nav">
                                @foreach($tienda->socials as $social)
								<li><a href="http://{{$social->url.'/'.$social->uri}}"><i class="fab fa-{{strtolower($social->nombre)}}"></i></a></li>
                                @endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
        <!--FIN PRIMERA BARRA NAVBAR-->

        <!--====================================
                SEGUNDA BARRA NAVBAR (Logotipo, moneda_deshabilitado, carrito, login, logout)
        ===========================================-->

		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-md-4" style="display: flex;align-items: center">

						<!--=================
							LOGOTIPO
							===============-->
						<div class="logo pull-left">
							<a href="/"><img style="max-height:60px" src="{{asset('images/uploads/tiendas/navbar').'/'.$tienda->img}}" alt="" /></a>
						</div>

						<!--=================
							BTN CLIENTE
							===============-->
						<div class="btn-group" style="margin-left: 30px">
                            @if(Auth::check() && ($tienda->clientes()->where('user_id', Auth::user()->id)->first()->pivot->cliente ?? false))
                                <div class="btn-group">
                                    <button style="display:flex;align-items: center;" id="btn-switch-cliente" class="btn btn-comerciocentral">
                                        <i class="fa fa-check-circle"></i>
                                        <div class="text-btn-cliente">Soy cliente</div>
                                    </button>
                                </div>
                                @else
                            <div class="btn-group"  style="cursor:{{Auth::check()? 'pointer':'not-allowed'}} !important;"  data-toggle="tooltip" data-placement="bottom" title="{{Auth::check()? '' : 'Debe iniciar sesion o registrarse'}}">
                                <button style="display:flex;align-items: center;" id="btn-switch-cliente" style="cursor:{{Auth::check()? 'pointer':'not-allowed'}} !important;" class="btn btn-cliente" data-user-id="{{ Auth::check() ? Auth::user()->id : '' }}"
                                    {{Auth::check()? '' : 'disabled'}}>
                                    <i class="fa fa-users"></i>
									<div class="text-btn-cliente">Hazte Cliente</div>

                                </button>
                            </div>
                            @endif
								@include('frontend.templates.modals.modal-block-cliente')

							<!--===========================
								SELECTOR DE MONEDA
								======================-->
							<!--div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canada</a></li>
									<li><a href="">UK</a></li>
								</ul>
							</div-->

							<!--div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canadian Dollar</a></li>
									<li><a href="">Pound</a></li>
								</ul>
							</div-->
						</div>
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-righ">
							<ul class="nav navbar-nav pull-right">
								<li><a class="{{ Request::segment(1) === 'cuenta' ? 'active' : null }}" href="{{env('APP_URL').'/cuenta?redirectID='.$tienda->id}}"><i class="fa fa-user"></i> Cuenta</a></li>
								<li>
                                    <a class="{{ Request::segment(1) === 'carrito' ? 'active' : null }}"  href="{{url('/carrito')}}">
                                        <i class="fa fa-shopping-cart"></i>
                                        Carrito
                                        <span class="badge badge-carrito" style="background-color: red;">{{Session::has($cartname) ? Session::get($cartname)->cantidadTotal : ''}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="checkout-link {{ Request::segment(1) === 'checkout' ? 'active' : null }} {{ Session::has($cartname) ? '' : 'display-none-imp' }}"  href="{{url('/checkout')}}">
                                        <i class="fa fa-shopping-bag"></i>
                                        Finalizar Compra
                                    </a>
                                </li>
								@guest
								<li><a href="{{env('APP_URL').'/login?tienda='.$domain}}"><i class="fa fa-lock"></i> Iniciar sesion</a></li>
								@else

								<li><a href="{{ route('logout', ['domain' => $domain]) }}" onclick="event.preventDefault();
								document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i> Logout</a></li>

                                    @if(Auth::check() && Auth::user()->role=='admin' && $is_owner)
                                        <li><a href="{{url('/admin')}}"><i class="fa fa-user-cog"></i> Admin</a></li>
                                    @endif

                                <form id="logout-form" action="{{ route('logout', ['domain' => $domain]) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
								@endif
							</ul>
						</div>


					</div>
				</div>
			</div>
		</div><!--/header-middle-->
        <!--FIN SEGUNDA BARRA NAVBAR-->

        <!--=================================
                NAVBAR PRINCIPAL (inicio, productos, blog, contacto)
        =======================================-->


		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-7 col-md-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="/" class="{{ url()->current() === url('/') ? 'active' : null }}">Inicio</a></li>
								<li><a href="/productos" class="{{ Request::segment(1) === 'productos' || Request::segment(1) === 'producto' ? 'active' : null }}">Productos</a></li>
								<li><a href="/noticias" class="{{ Request::segment(1) === 'noticias' ? 'active' : null }}">Noticias</a></li>
                                <li><a href="/certificaciones" class="{{ Request::segment(1) === 'certificaciones' ? 'active' : null }}">Certificaciones</a></li>
								<li><a href="/contacto" class="{{ Request::segment(1) === 'contacto' ? 'active' : null }}">Contacto</a></li>
							</ul>
						</div>
					</div>

                    <div class="col-sm-5 col-md-3 hidden-xs">
                        @if(url()->current() === url('/') || Request::segment(1) === 'checkout' || Request::segment(1) === 'contacto' || Request::segment(1) === 'carrito')
                            <a href="{{ url('/certificaciones') }}">
                        <div class="certificado">
                            <div class="cert-icon">
                                <svg class="" width="50" height="50">
                                    <circle cy="25" cx="25" r="20" style="fill: {{ $certificacion ? '#68ca00' : 'yellow' }}"></circle>
                                </svg>

                                <i class="fa fa-store-alt store" style="color:{{ $certificacion ? 'white' : 'black' }}"></i>

                                <i class="fa fa-{{ $certificacion ? 'check' : 'times' }}-circle check" style="color:{{ $certificacion ? '#0f9500' :'red' }}"></i>

                            </div>
                            <div class="cert-text">
                                <div class="cert-title">
                                    {{ $certificacion ? 'Tienda Certificada' : 'Sin Cetificacion' }}
                                </div>
                                <div class="cert-details">Pulsa para ver detalles</div>
                            </div>

                        </div>
                            </a>
                            @else

                                <form class="search-form">
                                    <input name="search" type="text" class="textbox" placeholder="Buscar">
                                    <button title="Search" value="" type="submit" class="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </form>

                        @endif
                    </div>



                <!--.fin FORM busqueda-->
				</div>
			</div>
		</div><!--/header-bottom-->

        <div class="container hidden-sm hidden-md hidden-lg" style="margin-bottom:50px">
            <div class="row">
                <div class="col-xs-6 certificado-container">
                    @if(url()->current() === url('/'))
                    <a href="{{ url('/certificaciones') }}">
                    <div class="certificado">
                        <div class="cert-icon">
                            <svg class="" width="50" height="50">
                                <circle cy="25" cx="25" r="20" style="fill: {{ $certificacion ? '#68ca00' : 'yellow' }}"></circle>
                            </svg>

                            <i class="fa fa-store-alt store" style="color:{{ $certificacion ? 'white' : 'black' }}"></i>

                            <i class="fa fa-{{ $certificacion ? 'check' : 'times' }}-circle check" style="color:{{ $certificacion ? '#0f9500' :'red' }}"></i>

                        </div>
                        <div class="cert-text">
                            <div class="cert-title">
                                {{ $certificacion ? 'Tienda Certificada' : 'Sin Cetificacion' }}
                            </div>
                            <div class="cert-details">Pulsa para ver detalles</div>
                        </div>

                    </div>
                    </a>
                        @endif
                </div>
            </div>
        </div>
        <!--FIN NAVBAR PRINCIPAL-->


	</header><!--/header-->

	@yield('content')

	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><img style="max-height: 60px" src="{{asset('images/uploads/tiendas/navbar').'/'.$tienda->img}}"></h2>
							<p>{{$tienda->info}}</p>
						</div>
					</div>
					<div class="col-sm-7">

						@foreach($tienda->teammembers as $member)
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('images/uploads/members').'/'.$member->img_member}}" alt="" />
									</div>
									<!--div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div-->
								</a>
								<p>{{$member->nombre}}</p>
								<h2>{{$member->cargo}}</h2>
							</div>
						</div>

						@endforeach


					</div>
					<div class="col-sm-3">
						<div class="address text-center">
							<img src="{{asset('images/home/map.png')}}" alt="" />
							<p>
                                @if($tienda->direccion->first())
                                {{$tienda->direccion->first()->calle.' #'. $tienda->direccion->first()->numero}}<br>
                            {{$tienda->direccion->first()->poblacion}} <br>
                                    {{$tienda->direccion->first()->ciudad}}
                                    @endif
                            </p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2" style="margin:0">
						<div class="single-widget">
							<h2>Acerca de</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Nosotros</a></li>
								<li><a href="#">Servicios</a></li>
								<!--li><a href="#">Garantia</a></li>
								<li><a href="#">Politica de privacidad</a></li>
								<li><a href="#">Terminos y condiciones</a></li-->
							</ul>
						</div>
					</div>

					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Redes sociales</h2>
							<ul class="nav nav-pills nav-stacked">
                                @foreach($tienda->socials as $social)
								<li><a href="http://{{$social->url.'/'.$social->uri}}">{{$social->nombre}}</a></li>
                                @endforeach
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Mi cuenta</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href=""> Cuenta</a></li>
								@guest
								<li><a href="/login"> Iniciar sesion</a></li>
								@else
								<li><a href="{{ route('logout', ['domain' => $domain]) }}" onclick="event.preventDefault();
								document.getElementById('logout-form-footer').submit();"> Logout</a></li>



                                <form id="logout-form-footer" action="{{ route('logout', ['domain' => $domain]) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
								@endif
							</ul>
						</div>
					</div>


					<div class="col-xs-12 col-md-4 pull-right">
						<div class="single-widget">
							<h2>Déjanos tu correo</h2>
							<form action="#" class="searchform">
                                <div class="input-searchform">
                                    <input class="form-control" type="email" placeholder="Tu correo electronico" />
                                    <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-right" ></i></button>
                                </div>
								<p>Consigue las ultimas actualizaciones <br />y noticias de nuestro sitio...</p>
							</form>
						</div>
					</div>
                </div>

            </div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © {{date("Y")}} {{config('app.name')}}. Todos los derechos reservados.</p>
					<p class="pull-right">Ir a <span><a target="_blank" href="{{env('APP_PROTOCOL')}}://comerciocentral.{{env('APP_DOMAIN')}}">Comercio Central</a></span></p>
				</div>
			</div>
		</div>

	</footer><!--/Footer-->
    <div class="cart-float-btn">
        <a href="{{ url('/carrito') }}">
            <i class="fa fa-shopping-cart"></i>
            <span class="badge badge-carrito">{{Session::has($cartname) ? Session::get($cartname)->cantidadTotal : ''}}</span>
        </a>
        <div class="precio-total-float">
            @if(Session::has($cartname) && Session::has($envioname))
            <p>$ {{  number_format(Session::get($cartname)->precioTotal + Session::get($envioname)->precio,0,'','.')  }}</p>
                @elseif(Session::has($cartname))
                <p>$ {{  number_format(Session::get($cartname)->precioTotal,0,'','.')  }}</p>
            @else
            <p>vacio</p>
            @endif
        </div>
    </div>
	@if(Auth::check() && Auth::user()->role=='admin')
	<!--script type="text/javascript" src="{{asset('js/app.js')}}"></script-->
	@endif


    <script src="{{asset('js/jquery.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	@if(Request::segment(1) == 'contacto')
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&key={{env('GMAP_API_KEY')}}"></script>
	<script type="text/javascript" src="{{asset('js/gmaps.js')}}"></script>
	<script src="{{asset('js/contact.js')}}"></script>
	@endif

    @if(Request::segment(1) == 'checkout')
        <script src="//storage.googleapis.com/installer/khipu.js"></script>
        @endif

	<script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('js/price-range.js')}}"></script>
    <script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>
	<script src="{{asset('js/jquery.barrating.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>

</body>
</html>
