<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cuenta | {{ Auth::user()->name}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{asset('dist/js/adminlte.js')}}"></script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Select2 dependencies -->
    <link href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css')}}" rel="stylesheet" />
    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js')}}" defer></script>
    <!--script src="{{asset('js/ckeditor.js')}}"></script-->

    <style>
        .search-form {
            outline: 0;
            float: left;
            -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            -webkit-border-radius: 4px;
            border-radius: 4px;
        }

        .search-form > .textbox {
            outline: 0;
            height: 42px;
            width: 244px;
            line-height: 42px;
            padding: 0 16px;
            background-color: rgba(255, 255, 255, 0.8);
            color: #212121;
            border: 0;
            float: left;
            -webkit-border-radius: 4px 0 0 4px;
            border-radius: 4px 0 0 4px;
        }

        .search-form > .textbox:focus {
            outline: 0;
            background-color: #FFF;
        }

        .search-form > .button {
            outline: 0;
            background: none;
            background-color: rgba(38, 50, 56, 0.8);
            float: left;
            height: 42px;
            width: 42px;
            text-align: center;
            line-height: 42px;
            border: 0;
            color: #FFF;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: 16px;
            text-rendering: auto;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
            -webkit-transition: background-color .4s ease;
            transition: background-color .4s ease;
            -webkit-border-radius: 0 4px 4px 0;
            border-radius: 0 4px 4px 0;
        }

        .search-form > .button:hover {
            background-color: rgba(0, 150, 136, 0.8);
        }

        .block-ellipsis {
            display: block;
            display: -webkit-box;
            max-width: 100%;
            height: 86px;
            margin: 0 auto;

            line-height: 2;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div id="app">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>



            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                @if($tienda)
                    <a style="margin-right: 10px" href="{{env('APP_PROTOCOL').'://'.$tienda->dominio. '.comerciocentral.'.env('APP_DOMAIN')}}" class="float-right"> <button class="btn btn-comerciocentral">
                            <i class="fa fa-store"></i>
                            Volver a <strong>{{$tienda->nombre}}</strong></button></a>
                @endif
                <a href="/" class="float-right"> <button class="btn btn-comerciocentral-dark">
                        <i class="fa fa-building"></i>
                        Ir al <strong>Mall</strong></button></a>

            </ul>

            <!--=====================================
                    BOTONES DE VISTA DE PAGINA
            ==========================================-->




        </nav>
        <!--............. /.fin navbar............. -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/admin') }}" class="brand-link">
                <img src="{{ asset('/images/system/navbar-new2.png') }}" alt="AdminLTE Logo" class="mx-auto img-fluid"
                     style="opacity: .8;max-height: 90px">

            </a>

            <!-- Sidebar -->
            <div class="sidebar scrollbar-mini" style="height:calc(100% - 9em)">
                <!-- Sidebar user panel (optional) -->
                <div class="mt-3 pb-3 mb-3">
                    <div class="text-center">
                        <img style="max-height: 60px" src="{{asset('images/uploads/users').'/' . Auth::user()->img}}" alt="User Image">
                    </div>
                    <div class="info">
                        <div class="text-center">
                            <span style="color: #b3a9ff" class="mt-3 mb-3 d-block"></span>

                            <a class="btn-comerciocentral-dark fluid-logout" href="{{route('logout.external')}}" onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                Cerrar Sesión
                            </a>

                            <form id="logout-form" action="{{ route('logout.external') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="{{url('/compras')}}" class="{{ Request::path() === 'compras' ? 'nav-link active' : 'nav-link' }}">
                                <i class="nav-icon fa fa-shopping-bag"></i>
                                <p>Mis compras</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/cuenta')}}" class="{{ Request::path() === 'cuenta' ? 'nav-link active' : 'nav-link' }}">
                                <i class="nav-icon fa fa-user"></i>
                                <p>Cuenta</p>
                            </a>
                        </li>

                        <!--li class="nav-item">
                            <a href="{{url('/cuenta/comentarios')}}" class="{{ Request::path() === 'cuenta/comentarios' ? 'nav-link active' : 'nav-link' }}">
                                <i class="nav-icon fa fa-comment"></i>
                                <p>Mis comentarios</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{url('/cuenta/config')}}" class="{{ Request::path() === 'cuenta/config' ? 'nav-link active' : 'nav-link' }}">
                                <i class="nav-icon fa fa-cog"></i>
                                <p>Configuracion</p>
                            </a>
                        </li-->





                        <!--li class="nav-item">
                            <a href="{{url('admin/clientes')}}"
                               class="{{ Request::path() === 'admin/clientes' ? 'nav-link active' : 'nav-link' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Clientes</p>
                            </a>
                        </li-->







                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">

            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <!-- NO QUITAR -->
            <strong>Comercio Central
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 1.0
                </div>
            </strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
</div>

<script src="{{asset('js/areyousure.js')}}" defer></script>
<script src="{{asset('js/ays-beforeunload-shim.js')}}" defer></script>
<script src="{{asset('js/user.js')}}" defer></script>
<!--script>
    setTimeout(function(){
        CKEDITOR.replace( 'blog-textarea' );
    },1000);
</script-->
<!-- Select2 Dependencies js -->


</body>

</html>