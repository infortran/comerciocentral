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
                            <h3>La nueva tienda virtual de confianza <strong>GRATIS</strong> y <strong>CERTIFICADA</strong></h3>
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


                            <!--form action="" method="post">
                                @csrf
                                <button type="submit">logout</button>
                            </form>
                        <div class="payment_form white-bg wow fadeInDown" data-wow-duration="1.2s" data-wow-delay=".2s">
                            <div class="info text-center">
                                <h4>Como se llama tu tienda?</h4>
                                <p>Verifica si el nombre de tu tienda esta disponible</p>
                            </div>
                            <div class="form">
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Nombre de tu tienda">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Tu correo electronico">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit_btn">
                                <button class="boxed-btn3" type="submit">Continuar</button>
                            </div>
                        </div-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->

    <!-- service_area_start  -->
    <div class="service_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-90">
                        <span class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s"></span>
                        <h3 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">Que tenemos para ofrecerte</h3>
                        <p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">Servicios ajustados a las necesidades de tu negocio</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single_service wow fadeInLeft" data-wow-duration="1.2s" data-wow-delay=".5s">
                        <div class="service_icon_wrap text-center">
                            <div class="service_icon ">
                                <img src="img/svg_icon/service_1.png" alt="">
                            </div>
                        </div>
                        <div class="info text-center">
                            <span>Home Loan</span>
                            <h3>$3000-$10000</h3>
                        </div>
                        <div class="service_content">
                            <ul>
                                <li> Borrow - $350 over 3 months </li>
                                <li> Interest rate - 292% pa fixed</li>
                                <li>Total amount payable - $525.12</li>
                                <li>Representative - 1,286% APR</li>
                            </ul>
                            <div class="apply_btn">
                                <button class="boxed-btn3" type="submit">Apply Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single_service wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                        <div class="service_icon_wrap text-center">
                            <div class="service_icon ">
                                <img src="img/svg_icon/service_2.png" alt="">
                            </div>
                        </div>
                        <div class="info text-center">
                            <span>car Loan</span>
                            <h3>$3000-$10000</h3>
                        </div>
                        <div class="service_content">
                            <ul>
                                <li> Borrow - $350 over 3 months </li>
                                <li> Interest rate - 292% pa fixed</li>
                                <li>Total amount payable - $525.12</li>
                                <li>Representative - 1,286% APR</li>
                            </ul>
                            <div class="apply_btn">
                                <button class="boxed-btn3" type="submit">Apply Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single_service wow fadeInRight" data-wow-duration="1.2s" data-wow-delay=".5s">
                        <div class="service_icon_wrap text-center">
                            <div class="service_icon ">
                                <img src="img/svg_icon/service_3.png" alt="">
                            </div>
                        </div>
                        <div class="info text-center">
                            <span>Education Loan</span>
                            <h3>$3000-$10000</h3>
                        </div>
                        <div class="service_content">
                            <ul>
                                <li> Borrow - $350 over 3 months </li>
                                <li> Interest rate - 292% pa fixed</li>
                                <li>Total amount payable - $525.12</li>
                                <li>Representative - 1,286% APR</li>
                            </ul>
                            <div class="apply_btn">
                                <button class="boxed-btn3" type="submit">Apply Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service_area_end  -->

    <!-- about_area_start  -->
    <div class="about_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="about_img wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s">
                        <img src="{{ asset('images/system/mockup.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="about_info pl-68">
                        <div class="section_title wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".3s">
                            <h3>Tu tienda en todos tus dispositivos</h3>
                        </div>
                        <p class="wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".4s">
                            Revisa y administra tu tienda en linea a traves de cualquier dispositivo con conectividad a internet
                        </p>
                        <div class="about_list">
                            <ul>
                                <li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".5s">Diseño responsivo.</li>
                                <li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".6s">Revisa tu tienda en cualquier lugar.</li>
                                <li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".7s">Administra tus ventas y productos.</li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".8s">
                                <li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".9s">Amigable con cualquier dispositivo.</li>
                            </ul>
                        </div>
                        <div class="about_btn wow fadeInRight" data-wow-duration="1.3s" data-wow-delay=".5s">
                            <a class="boxed-btn3" href="apply.html">About Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about_area_end  -->

    <div class="works_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-90">
                        <span class="wow lightSpeedIn" data-wow-duration="1s" data-wow-delay=".1s"></span>
                        <h3 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">Como funciona</h3>
                        <p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">Tu provees fotos, precios y
                        medios de envio. Nostros te proveemos el sistema.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="single_works wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
                        <span>
                            01
                        </span>
                        <h3>Busca el nombre de tu tienda</h3>
                        <p>Lo ingresas, buscamos si esta disponible, y despues de registrar tus datos ya puedes
                        guardar tus productos.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="single_works wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                        <span>
                            02
                        </span>
                        <h3>Configura tu tienda</h3>
                        <p>Te mostraremos un asistente de configuracion que te ayudara
                        en el proceso de la creacion de tu tienda</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="single_works wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s">
                        <span>
                            03
                        </span>
                        <h3>Selecciona tu metodo de pago</h3>
                        <p>Puedes elegir entre pagar a contra entrega, hasta realizar transacciones a traves de Webpay
                        y recibir depositos bancarios</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion_area">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-lg-6">
                    <div class="faq_ask pl-68">
                        <h3 class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s">Frequently ask</h3>
                        <div id="accordion">
                            <div class="card wow fadeInUp" data-wow-duration="1.1s" data-wow-delay=".3s">
                                <div class="card-header" id="headingOnee">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOnee" aria-expanded="true" aria-controls="collapseOnee">
                                            Adieus who direct esteem It esteems luckily?
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOnee" class="collapse show" aria-labelledby="headingOnee" data-parent="#accordion">
                                    <div class="card-body">
                                        Esteem spirit temper too say adieus who direct esteem esteems luckily or picture placing drawing.
                                    </div>
                                </div>
                            </div>
                            <div class="card wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".4s">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            Who direct esteem It esteems?
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" style="">
                                    <div class="card-body">Esteem spirit temper too say adieus who direct esteem esteems luckily or picture placing drawing.
                                    </div>
                                </div>
                            </div>
                            <div class="card wow fadeInUp" data-wow-duration="1.3s" data-wow-delay=".5s">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Duis consectetur feugiat auctor?
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion" style="">
                                    <div class="card-body">Esteem spirit temper too say adieus who direct esteem esteems luckily or picture placing drawing.
                                    </div>
                                </div>
                            </div>
                            <div class="card wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".6s">
                                <div class="card-header" id="headingThree4">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree4" aria-expanded="false" aria-controls="collapseThree4">
                                            Consectetur feugiat auctor?
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree4" class="collapse" aria-labelledby="headingThree4" data-parent="#accordion" style="">
                                    <div class="card-body">Esteem spirit temper too say adieus who direct esteem esteems luckily or picture placing drawing.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- testimonial_area  -->
    <div class="testimonial_area  ">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="testmonial_active owl-carousel">
                        <div class="single_carousel">
                            <div class="row">
                                <div class="col-lg-11">
                                    <div class="single_testmonial d-flex align-items-center">
                                        <div class="thumb">
                                            <img src="img/testmonial/author.png" alt="">
                                            <div class="quote_icon">
                                                <i class="Flaticon flaticon-quote"></i>
                                            </div>
                                        </div>
                                        <div class="info">
                                            <p>"Working in conjunction with humanitarian aid agencies, we have supported programmes to help alleviate human suffering through animal welfare when people might depend on livestock as their only source of income or food.</p>
                                            <span>- Micky Mouse</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_carousel">
                            <div class="row">
                                <div class="col-lg-11">
                                    <div class="single_testmonial d-flex align-items-center">
                                        <div class="thumb">
                                            <img src="img/testmonial/author.png" alt="">
                                            <div class="quote_icon">
                                                <i class=" Flaticon flaticon-quote"></i>
                                            </div>
                                        </div>
                                        <div class="info">
                                            <p>"Working in conjunction with humanitarian aid agencies, we have supported programmes to help alleviate human suffering through animal welfare when people might depend on livestock as their only source of income or food.</p>
                                            <span>- Micky Mouse</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_carousel">
                            <div class="row">
                                <div class="col-lg-11">
                                    <div class="single_testmonial d-flex align-items-center">
                                        <div class="thumb">
                                            <img src="img/testmonial/author.png" alt="">
                                            <div class="quote_icon">
                                                <i class="Flaticon flaticon-quote"></i>
                                            </div>
                                        </div>
                                        <div class="info">
                                            <p>"Working in conjunction with humanitarian aid agencies, we have supported programmes to help alleviate human suffering through animal welfare when people might depend on livestock as their only source of income or food.</p>
                                            <span>- Micky Mouse</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /testimonial_area  -->

    <div class="brad_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="brad_active owl-carousel">
                        <div class="single_brand wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                            <img src="img/brand/1.png" alt="">
                        </div>
                        <div class="single_brand wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                            <img src="img/brand/2.png" alt="">
                        </div>
                        <div class="single_brand wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
                            <img src="img/brand/3.png" alt="">
                        </div>
                        <div class="single_brand wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                            <img src="img/brand/4.png" alt="">
                        </div>
                        <div class="single_brand wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s">
                            <img src="img/brand/5.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="apply_loan overlay">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-7">
                    <div class="loan_text wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s">
                        <h3>Apply for a Loan for your startup,
                            education or company</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5">
                    <div class="loan_btn wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".4s">
                        <a class="boxed-btn3" href="apply.html">Apply Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
