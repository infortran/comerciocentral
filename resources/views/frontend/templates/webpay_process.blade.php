
    <form id="form-webpay" action="{{$url_redirection}}" method="POST">
        <input type="hidden" value="{{$token_ws}}" name="token_ws">
    </form>

    <script>
        window.localStorage.clear();
        window.localStorage.setItem("response_code", "{{$response_code}}");
        window.localStorage.setItem("card_number", "{{$card_number}}");
        window.localStorage.setItem("authorization_code", "{{$authorization_code}}");
        window.localStorage.setItem("amount", "$ {{$amount}}");
        window.localStorage.setItem("shares_number", "{{$shares_number}}");
        window.localStorage.setItem("buy_order", "{{$buy_order}}");
        window.localStorage.setItem("nombre", "{{$nombre}}");
        window.localStorage.setItem("direccion", "{{$direccion}}");
        document.getElementById('form-webpay').submit();
    </script>

