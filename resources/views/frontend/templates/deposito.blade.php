@extends('frontend.templates.principal')

@section('content')
    <section>

        <div class="container">
            <h1 class="titulo-principal">Deposito bancario</h1>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>
                                <div class="icon-titulo">
                                    <i class="fa fa-check-circle"></i>
                                </div>
                                Confirma tu deposito
                            </h4>
                        </div>

                        <form action="{{ url('/payment/final_deposito') }}" class="panel-body text-center" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="">Ingresa una fotografia clara o una captura de pantalla de tu comprobante de deposito para confirmar tu compra</label>
                            <img id="img-voucher" class="center-block" style="max-height: 200px" src="{{ asset('images/system/comprobante_placeholder.jpg') }}" alt="">
                            <label style="display:inline-block;margin-top:20px" class="infoButton">
                                <i class="fa fa-file-import"></i>
                               <small style="font-size: 12px">Cargar comprobante</small>
                                <input style="display: none" type="file" name="voucher" id="input-img-voucher">
                            </label>
                            @error('voucher')
                                <div class="alert alert-danger">
                                    El <strong>Comprobante</strong> es obligatorio
                                </div>
                            @enderror
                            <hr>
                            <button class="btn-hover color-1">Confirmar deposito</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>
                                <div class="icon-titulo">
                                    <i class="fa fa-file-invoice-dollar"></i>
                                </div>
                                Datos para depositar
                            </h4>
                        </div>
                        <div class="panel-body">
                            <h5>Datos para la transferencia</h5>
                            <div class="list-group">
                                <div class="list-group-item list-table list-table-50">
                                    <div>Nombre</div>
                                    <div>Nombre de la empresa</div>
                                </div>
                                <div class="list-group-item list-table list-table-50">
                                    <div>R.U.T</div>
                                    <div>11.111.111-1</div>
                                </div>
                                <div class="list-group-item list-table list-table-50">
                                    <div>Banco</div>
                                    <div>Nombre del banco</div>
                                </div>
                                <div class="list-group-item list-table list-table-50">
                                    <div>Tipo de cuenta</div>
                                    <div>tipo</div>
                                </div>
                                <div class="list-group-item list-table list-table-50">
                                    <div>Numero de cuenta</div>
                                    <div>4678 4875 2980 0000</div>
                                </div>

                                <div class="list-group-item list-table list-table-50">
                                    <div>Email</div>
                                    <div>email@empresa.cl</div>
                                </div>
                                <div class="list-group-item list-table list-table-50">
                                    <div>Numero de contacto</div>
                                    <div>+569 12931234</div>
                                </div>

                                <div class="list-group-item list-table list-table-50">
                                    <div><strong>Monto</strong></div>
                                    <div><strong>$1.000</strong></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>

    </script>

    @endsection
