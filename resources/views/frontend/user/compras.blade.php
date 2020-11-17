@extends('frontend.user.principal')

@section('content')
    <section>
        <div class="container">
            <h1 class="titulo-principal">Mis compras</h1>
            <div class="row">
                <div class="col-12 compra-container">
                    <div class="compra">
                        <div class="header d-none d-sm-block">
                            <div class="hora">20:00</div>
                            <div class="fecha">10/10/2020</div>
                            <div class="hace">Hace 5 minutos</div>
                        </div>
                        <div class="img">
                            <img src="{{asset('images/uploads/tiendas/navbar/deliciasurbanas.png')}}" alt="">
                        </div>
                        <div class="text d-none d-sm-block">
                            Delicias Urbanas
                        </div>
                        <div class="precio">
                            $ 1.000
                        </div>

                        <button class="btn btn-comerciocentral-dark" data-target="#modal-compra-detalle" data-toggle="modal">Ver detalles</button>
                    </div>

                </div>
            </div>
        </div>
    </section>

    @include('frontend.user.modal-compra-detalle')
@endsection