<div>
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    @if ($errors->any())
    <div class="alert alert-danger" id="errDiv">
        <h5>Whoops! Something must have gone wrong...</h5>
        @foreach ($errors->all() as $error)
        <p> <em>{{$error}}</em> </p>
        @endforeach
    </div>
    @endif
</div>

<script type="text/javascript">
    function removeErrorDiv()
    {
        let err = document.querySelector('#errDiv');
        setTimeout(() => {
            err.remove()
        }, 5000)
    }
    removeErrorDiv()
</script>