<div>
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    @if ($errors->any())
    <div class="col-md-8 alert alert-danger">
        <h5>Whoops! Something must have gone wrong...</h5>
        @foreach ($errors->all() as $error)
        <p> <em>{{$error}}</em> </p>
        @endforeach
    </div>
    @endif
</div>