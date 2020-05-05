<!--HOME USER PLANTILLA HEADER Y FOOTER-->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | {{ config('app.name') }}</title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!--link href="{{asset('plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet"-->
    <script src="https://kit.fontawesome.com/fe859275e0.js" crossorigin="anonymous"></script>
    <link href="{{asset('css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('css/main.css')}}" rel="stylesheet">
	<link href="{{asset('css/responsive.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>


        .card {
            /* Add shadows to create the "card" effect */
            background: #efefef;
            border-radius: 3px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
        }

        .card-cart{
            background: #fbfbfb !important;
            padding: 30px;
        }

        /* On mouse-over, add a deeper shadow */
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        /* Add some padding inside the card container */
        .card-body {
            padding: 20px;
        }

        .borderless td, .borderless th {
            border: none !important;
        }
    </style>
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

					<a class="pull-right" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form-nav').submit();">
                    	<button style="margin: 10px" class="btn btn-warning">Salir</button>
                    </a>
                    <form id="logout-form-nav" action="{{ route('logout') }}" method="POST"
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
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="{{url('/contacto')}}"><i class="fa fa-phone"></i> {{$header->telefono}}</a></li>
								<li><a href="{{url('/contacto')}}"><i class="fa fa-envelope"></i> {{$header->email}}</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
                                @foreach($siteSocials as $social)
								<li><a href="http://{{$social->socials->url.'/'.$social->uri}}"><i class="fab fa-{{strtolower($social->socials->nombre)}}"></i></a></li>
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
					<div class="col-md-4 clearfix">

						<!--=================
							LOGOTIPO
							===============-->
						<div class="logo pull-left">
							<a href="/"><img src="{{asset('images/system').'/'.$header->img_header}}" alt="" /></a>
						</div>
						<div class="btn-group pull-right clearfix">

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
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">
								<li><a class="{{ Request::segment(1) === 'cuenta' ? 'active' : null }}" href="{{url('/cuenta')}}"><i class="fa fa-user"></i> Cuenta</a></li>

                                @if(Auth::check() && Session::has('cart'))
								<li><a class="{{ Request::segment(1) === 'checkout' ? 'active' : null }}"  href="{{url('/checkout')}}"><i class="fa fa-cash-register"></i> Checkout</a></li>
                                @endif
								<li>
                                    <a class="{{ Request::segment(1) === 'carrito' ? 'active' : null }}"  href="{{url('/carrito')}}">
                                        <i class="fa fa-shopping-cart"></i>
                                        Carrito
                                        <span id="badge-carrito" class="badge" style="background-color: red;">{{Session::has('cart') ? Session::get('cart')->cantidadTotal : ''}}</span>
                                    </a>

                                </li>
								@guest
								<li><a href="/login"><i class="fa fa-lock"></i> Iniciar sesion</a></li>
								@else
                                    @if(Auth::check() && Auth::user()->role=='admin')
                                    <li><a href="{{url('/admin')}}"><i class="fa fa-user-cog"></i> Administracion</a></li>
                                    @endif
								<li><a href="{{ route('logout') }}" onclick="event.preventDefault();
								document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i> Logout</a></li>



                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
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
					<div class="col-sm-8">
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
								<li><a href="/blog" class="{{ Request::segment(1) === 'blog' ? 'active' : null }}">Noticias</a></li>
								<li><a href="/contacto" class="{{ Request::segment(1) === 'contacto' ? 'active' : null }}">Contacto</a></li>
							</ul>
						</div>
					</div>
                    <!-- ============================
                         FORMULARIO DE BUSQUEDA
                    ================================= -->
                    @if(isset($search))
                    <div class="col-sm-4" style="margin-top: 20px">
                        <form class="search-form">
                            <input name="search" type="text" class="textbox" placeholder="Buscar">
                            <button title="Search" value="" type="submit" class="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                    @endif


                <!--.fin FORM busqueda-->
				</div>
			</div>
		</div><!--/header-bottom-->
        <!--FIN NAVBAR PRINCIPAL-->

        @if(isset($search) && $search)
            <div class="container">
                <div class="alert alert-info">Resultados para tu busqueda <strong>"{{$search}}"</strong></div>
            </div>
        @endif
	</header><!--/header-->

	@yield('content')

	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><img src="{{asset('images/system') .'/'. $header->img_header}}"></h2>
							<p>{{$footer->info}}</p>
						</div>
					</div>
					<div class="col-sm-7">

						@foreach($members as $member)
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
						<div class="address">
							<img src="{{asset('images/home/map.png')}}" alt="" />
							<p>{{$footer->direccion}}</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Acerca de</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Nosotros</a></li>
								<li><a href="#">Servicios</a></li>
								<li><a href="#">Garantia</a></li>
								<li><a href="#">Politica de privacidad</a></li>
								<li><a href="#">Terminos y condiciones</a></li>
							</ul>
						</div>
					</div>

					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Redes sociales</h2>
							<ul class="nav nav-pills nav-stacked">
                                @foreach($siteSocials as $social)
								<li><a href="http://{{$social->socials->url.'/'.$social->uri}}">{{$social->socials->nombre}}</a></li>
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
								<li><a href="{{ route('logout') }}" onclick="event.preventDefault();
								document.getElementById('logout-form-footer').submit();"> Logout</a></li>



                                <form id="logout-form-footer" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
								@endif
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>Déjanos tu correo</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right" ></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
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
					<p class="pull-right">Diseñado por <span><a target="_blank" href="http://www.facebook.com/infortran">Infortran</a></span></p>
				</div>
			</div>
		</div>

	</footer><!--/Footer-->
	@if(Auth::check() && Auth::user()->role=='admin')
	<!--script type="text/javascript" src="{{asset('js/app.js')}}"></script-->
	@endif


    <script src="{{asset('js/jquery.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	@if(Request::segment(1) == 'contacto')
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script type="text/javascript" src="{{asset('js/gmaps.js')}}"></script>
	<script src="{{asset('js/contact.js')}}"></script>
	@endif

	<script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('js/price-range.js')}}"></script>
    <script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>
