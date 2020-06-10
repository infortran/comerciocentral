<form style="display:none" id="form-redirect" action="{{ 'http://'. $domain . '.comerciocentral.chi' }}" method="POST">
    @csrf
    <input type="hidden" name="session-id" value="{{ $sessionId }}">
</form>

<script>
    document.getElementById("form-redirect").submit();
</script>
