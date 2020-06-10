<form style="display:non" id="form-redirect" action="{{ 'http://'. $domain . '.comerciocentral.chi' }}" method="POST">
    @csrf
    <input type="hidden" name="session-id" value="{{ $sessionId }}">
    <button type="submit">Validar</button>
</form>

<script>
    document.getElementById("form-redirect");
</script>
