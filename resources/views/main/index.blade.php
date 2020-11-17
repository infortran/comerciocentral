@extends('main.templates.principal')

@section('content')
    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider  d-flex align-items-center slider_bg_1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-12 text-center">
                        <div class="slider_text">
                            <!--img style="max-height: 200px" class="mx-auto" src="{{asset('images/system/shop-optimized.png')}}" alt=""-->
                            <h3>Crea tu tienda <br> <strong>GRATIS</strong> y <strong>CERTIFICADA</strong></h3>
                        </div>
                    </div>
                    <div class="col-12 col-lg-10 col-xl-8">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('main.register') }}" method="POST" class="input-group mb-3">
                            @csrf
                            <input name="domain" autofocus type="text" class="form-control input-main" placeholder="Ingresa el nombre de tu tienda" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                            <div class="input-group-append">
                                <button class="input-group-text btn-input-main btn-hover color-1" id="basic-addon2">
                                        <i class="fa fa-shopping-cart" style="margin-right:10px"></i>
                                    <div class="d-none d-sm-inline-block">Crear mi tienda</div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
