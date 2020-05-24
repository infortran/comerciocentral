@extends('frontend.templates.principal')

@section('content')
    <section>
        <div id="error-webpay-container" class="container d-none">
            <div class="row">
                <div class="row text-center" style="margin-bottom: 20px">

                    <i class="fa fa-exclamation-triangle error-icon-anim" style="color: red;font-size: 100px"></i>
                    <h2>Error al procesar tu pago</h2>
                    <h4>Hubo un error cuando tratamos de procesar tu pago</h4>
                    <small>Revisa tus datos e intentalo de nuevo</small>
                    <hr>
                    <a href="{{url('/')}}">
                        <button class="btn-primary btn">
                            <i class="fa fa-home"></i>
                            Volver al Inicio
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div id="success-webpay-container" class="container d-none">
            <div class="row text-center" style="margin-bottom: 20px">
                <img style="max-height: 250px" class="center-block" src="{{asset('images/system/success.gif')}}" alt="">
                <h2>Muchas gracias por tu compra</h2>
                <h4>Hemos enviado un mensaje a tu correo electronico</h4>
                <small>Con los datos de tu boleta electrónica</small>
                <hr>
                <a href="{{url('/')}}">
                    <button class="btn-default btn" style="padding:20px 30px !important;margin-top:16px">
                        <i class="fa fa-home"></i>
                        Volver al Inicio
                    </button>
                </a>

                <a href="{{url('/cuenta')}}">
                    <button class="btn-primary btn">
                        <i class="fa fa-address-card"></i>
                        Ir a tu cuenta
                    </button>
                </a>
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <h4>Datos de tu compra</h4>
                        </div>
                        <div class="panel-body">
                            <div class="list-group text-center">
                                <div class="list-group-item">
                                    La orden sera entregada a...
                                </div>
                                <div class="list-group-item">
                                    <strong id="nombre-webpay"></strong>
                                </div>
                            </div>
                            <div class="list-group text-center">
                                <div class="list-group-item">
                                    Direccion de entrega
                                </div>
                                <div class="list-group-item">
                                    <strong id="direccion-webpay"></strong>
                                </div>
                            </div>
                            <div class="list-group">
                                <div class="list-group-item list-group-item-checkout">
                                    <div>
                                        Monto
                                    </div>
                                    <div class="text-right">
                                        <strong id="amount-webpay">$ 1.000</strong>
                                    </div>

                                </div>
                                <div class="list-group-item list-group-item-checkout">
                                    <div>
                                        Cuotas
                                    </div>
                                    <div class="text-right">
                                        <strong id="shares-number-webpay">0</strong>
                                    </div>

                                </div>
                                <div class="list-group-item list-group-item-checkout">
                                    <div>
                                        N° de orden <strong>(Guarda este numero para retirar en tienda)</strong>
                                    </div>
                                    <div class="text-right">
                                        <strong>N°<i id="buy-order-webpay">1</i></strong>
                                    </div>

                                </div>
                                <div class="list-group-item list-group-item-checkout">
                                    <div>
                                        Tarjeta
                                    </div>
                                    <div class="text-right">
                                        <strong>**** **** **** <i id="card-number-webpay">1234</i></strong>
                                    </div>

                                </div>
                                <div class="list-group-item list-group-item-checkout">
                                    <div>
                                        Cod. Autorización
                                    </div>
                                    <div class="text-right">
                                        <strong id="auth-code-webpay">1212</strong>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        var responseCode = window.localStorage.getItem("response_code");
        var errorContainer = document.getElementById("error-webpay-container");
        var successContainer = document.getElementById("success-webpay-container");
        if(responseCode == 0){
            var cardNumber = window.localStorage.getItem("card_number");
            var authCode = window.localStorage.getItem("authorization_code");
            var amount = window.localStorage.getItem("amount");
            var sharesNumber = window.localStorage.getItem("shares_number");
            var buyOrder = window.localStorage.getItem("buy_order");
            var nombre = window.localStorage.getItem("nombre");
            var direccion = window.localStorage.getItem("direccion");
            if(direccion == ""){
                direccion = "Retiro en tienda"
            }
            document.getElementById("card-number-webpay").innerHTML = cardNumber;
            document.getElementById("auth-code-webpay").innerHTML = authCode;
            document.getElementById("amount-webpay").innerHTML = amount;
            document.getElementById("shares-number-webpay").innerHTML = sharesNumber;
            document.getElementById("buy-order-webpay").innerHTML = buyOrder;
            document.getElementById("nombre-webpay").innerHTML = nombre;
            document.getElementById("direccion-webpay").innerHTML = direccion;

            successContainer.className = successContainer.className.replace("d-none", "");
            window.localStorage.clear();
        }else{
            errorContainer.className = errorContainer.className.replace("d-none", "");
        }




    </script>
@endsection
