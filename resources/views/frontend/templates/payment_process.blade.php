@extends('frontend.templates.principal')

@section('content')
    <section>
        <div class="container">
            <div class="row text-center">
                <div style="height:300px;position:relative">
                    <div class="loader" >
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <h2>Estamos procesando tu pago...</h2>
            </div>
        </div>
    </section>
    <form id="form-payment-access" action="{{ $form_action }}" method="POST">
        <input type="hidden" value="{{ $token_ws }}" name="token_ws">
    </form>

    <script>
        setTimeout(function(){
            document.getElementById('form-payment-access').submit();
        },2000)
    </script>
@endsection
