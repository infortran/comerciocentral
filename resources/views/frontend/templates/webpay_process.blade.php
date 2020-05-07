<form id="form_webpay" action="{{$url_redirection}}" method="POST">
    <input type="hidden" value="{{$token_ws}}" name="token_ws">
</form>

<script>
    document.getElementById('form_webpay').submit();
</script>
