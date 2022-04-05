@extends('layouts.auth')
@section('pageContent')

<div class="row">

    <div class="col-md-4" style="margin:auto;">
        <h1> <a href="/">BBKC LOGO here?</a> </h1>
    </div>

    <div class="col-md-8 mt-5 mb-2">
        <h3 class="ml-1">FORGOT YOUR PASSWORD/h3>
        <p><span class="ti-key"></span> Change your {{config('app.name')}} account password</p>
        <form method="post">

            <div class="col-sm-8">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Email *">
                </div>
            </div>

            <div class="col-sm-8">
                <div class="form-group">
                    <button class="btn fl-btn" type="submit">Change Pass</button>
                </div>

                <div class="form-group align-right">
                    &nbsp;&nbsp; No account ? <a href="{{route('register')}}"> Create One </a>
                </div>
            </div>
        </form>
    </div>

</div>

@endsection