<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Comercio Central</title>
    <meta name="description" content="El centro del comercio online.">
    <meta name="author" content="Freddy Perez">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/favicon.ico')}}">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="{{asset('css/bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('css/gijgo.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('css/slicknav.css')}}">

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please upgrade your browser to improve your experience and security.</p>
<![endif]-->

<!-- header-start -->
<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid ">
                <div class="header_bottom_border">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-2">
                            <div class="logo">
                                <a href="{{url('/')}}">
                                    <img class="img-navbar" style="height:{{url()->current() === url('/') ? '150':'90'}}px" src="{{asset('images/system/navbar-new2.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-7">

                        </div>
                        <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                            <div class="Appointment">
                                @guest
                                <div class="phone_num d-none d-xl-block">
                                    <span style="color:#fff; font-size:.9em"> Ya tienes una cuenta?</span>
                                </div>
                                <div class="d-none d-lg-block">
                                    <a class="boxed-btn4" href="{{url('login')}}">
                                        <i class="fa fa-key"></i>
                                        Ingresar</a>
                                </div>
                                    @else
                                    <div class="d-none d-lg-block">
                                        <a class="boxed-btn4" href="{{url('/logout')}}">
                                            <i class="fa fa-sign-out-alt"></i>
                                            Salir</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
<!-- header-end -->


@yield('content')





<!-- link that opens popup -->
<!-- JS here -->
<script src="{{asset('js/modernizr-3.5.0.min.js')}}"></script>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap4.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('js/ajax-form.js')}}"></script>
<script src="{{asset('js/waypoints.min.js')}}"></script>
<script src="{{asset('js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('js/scrollIt.js')}}"></script>
<script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('js/wow.min.js')}}"></script>
<script src="{{asset('js/nice-select.min.js')}}"></script>
<script src="{{asset('js/jquery.slicknav.min.js')}}"></script>
<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('js/plugins.js')}}"></script>
<script src="{{asset('js/gijgo.min.js')}}"></script>
<script src="{{asset('js/slick.min.js')}}"></script>



<!--contact js-->
<script src="{{asset('js/contacto.js')}}"></script>
<script src="{{asset('js/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{asset('js/jquery.form.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/mail-script.js')}}"></script>

<script src="{{asset('js/jquery.steps.js')}}"></script>

<script src="{{asset('js/comerciocentral.js')}}"></script>
</body>

</html>
