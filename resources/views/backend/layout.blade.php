<!--LAYOUT DEL MENU-->
<!--este layout muestra el menu con opciones, el diseño del usuario logueado la barra lateral el navbar entre otros aca el usuario debe ser admin para acceder a esta vista-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="tienda-id" content="{{ $tienda->id }}">

    <title>Administracion | {{ strtoupper($domain)}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
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



                <!-- Right navbar links ->
                <ul class="navbar-nav ml-auto">
                    <!- Messages Dropdown Menu ->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-comments"></i>
                            <span class="badge badge-danger navbar-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="#" class="dropdown-item">
                                <!- Message Start ->
                                <div class="media">
                                    <img src="dist/img/user1-128x128.jpg" alt="User Avatar"
                                        class="img-size-50 mr-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Brad Diesel
                                            <span class="float-right text-sm text-danger"><i
                                                    class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">Call me whenever you can...</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                <!- Message End ->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!- Message Start ->
                                <div class="media">
                                    <img src="dist/img/user8-128x128.jpg" alt="User Avatar"
                                        class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            John Pierce
                                            <span class="float-right text-sm text-muted"><i
                                                    class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">I got your message bro</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                <!- Message End ->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!- Message Start ->
                                <div class="media">
                                    <img src="dist/img/user3-128x128.jpg" alt="User Avatar"
                                        class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Nora Silvester
                                            <span class="float-right text-sm text-warning"><i
                                                    class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">The subject goes here</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                <- Message End ->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                        </div>
                    </li>
                    <- Notifications Dropdown Menu ->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>
                </ul-->

                <!--=====================================
                        BOTONES DE VISTA DE PAGINA
                ==========================================-->
               <a href="/" class="ml-auto"> <button class="btn btn-warning">Ir al sitio</button></a>
            </nav>
            <!--............. /.fin navbar............. -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{ url('/admin') }}" class="brand-link">
                    <img src="{{ asset('/images/system/navbar-new2.png') }}" alt="AdminLTE Logo" class="mx-auto d-block"
                        style="opacity: .8;max-height: 90px">

                </a>

                <!-- Sidebar -->
                <div class="sidebar" style="height:calc(100% - 9em);overflow-y: scroll;">
                    <!-- Sidebar user panel (optional) -->
                    <div class="mt-3 pb-3 mb-3">
                        <div class="text-center">
                            <img style="max-height: 60px" src="{{asset('images/uploads/tiendas/navbar').'/'. $domain . '.png'}}" alt="User Image">
                        </div>
                        <div class="info">
                            <div class="text-center">
                                <span style="color: #b3a9ff" class="mt-3 mb-3 d-block">{{ $domain_owner ? $domain .'.cl' : $domain . '.comerciocentral.cl' }}</span>

                                <a class="btn btn-dark" href="{{ route('logout', ['domain' => $domain]) }}" onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                    Cerrar Sesión
                                </a>

                                <form id="logout-form" action="{{ route('logout', ['domain' => $domain]) }}" method="POST"
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
                                <a href="{{url('/admin/ordenes')}}" class="{{ Request::path() === 'admin/ordenes' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fa fa-cash-register"></i>
                                    <p>Ordenes de compra</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{url('admin/clientes')}}"
                                   class="{{ Request::path() === 'clientes' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Clientes</p>
                                </a>
                            </li>

                            <li class="nav-item has-treeview {{ Request::path() === 'admin/productos' || Request::path() === 'admin/productos/categorias' || Request::path() === 'admin/productos/marcas' ? 'menu-open active' : '' }}">
                                <a href="{{url('admin/productos')}}"
                                    class="{{ Request::path() === 'productos' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fa fa-shopping-bag"></i>
                                    <p>
                                        Productos</p>
                                </a>

                            <ul class="nav nav-treeview ">
                                    <li class="nav-item">
                                        <a href="{{url('admin/productos')}}"
                                            class="{{ Request::path() === 'admin/productos' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="fa fa-book-open nav-icon"></i>
                                            <p>Catalogo</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/productos/categorias')}}"
                                            class="{{ Request::path() === 'admin/productos/categorias' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="fa fa-list nav-icon"></i>
                                            <p>Categorias</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/productos/marcas')}}"
                                            class="{{ Request::path() === 'admin/productos/marcas' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="far fa-copyright nav-icon"></i>
                                            <p>Marcas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="{{url('/admin/promociones')}}" class="{{ Request::path() === 'promociones' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fa fa-gift"></i>
                                    <p>
                                        Promociones

                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{url('/admin/banners')}}" class="{{ Request::path() === 'banners' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fa fa-images"></i>
                                    <p>
                                        Publicidad

                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/admin/blog')}}" class="{{ Request::path() === 'admin/blog' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fa fa-newspaper"></i>
                                    <p>
                                        Blog de noticias

                                    </p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="{{url('/admin/config')}}" class="{{ Request::path() === 'config' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fa fa-cogs"></i>
                                    <p>
                                        Configuracion

                                    </p>
                                </a>

                            <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="notas/todas"
                                            class="{{ Request::path() === 'config/main' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="fa fa-cog nav-icon"></i>
                                            <p>General</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="notas/favoritas"
                                            class="{{ Request::path() === 'config/cert' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="fa fa-award nav-icon"></i>
                                            <p>Certificacion</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="notas/archivadas"
                                            class="{{ Request::path() === 'config/socials' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="fa fa-thumbs-up nav-icon"></i>
                                            <p>Redes sociales</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="notas/archivadas"
                                           class="{{ Request::path() === 'config/themes' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="fa fa-palette nav-icon"></i>
                                            <p>Temas y colores</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="notas/archivadas"
                                           class="{{ Request::path() === 'config/user' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="fa fa-user nav-icon"></i>
                                            <p>Perfil de usuario</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="notas/archivadas"
                                           class="{{ Request::path() === 'config/upgrade' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="fa fa-magic nav-icon"></i>
                                            <p>Comprar mejoras</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>



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
                <strong>Infortran
                    <div class="float-right d-none d-sm-inline-block">
                        <b>Version</b> 1.0
                    </div>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
    </div>


    <script src="{{asset('js/admin.js')}}" defer></script>
    <!-- Select2 Dependencies js -->


</body>

</html>
