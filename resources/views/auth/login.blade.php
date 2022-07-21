@extends('layouts.auth')
@section('pageContent')

<div class="row">

    <div class="col-md-4" style="margin:auto;">
        <h1> <a href="/">BBKC LOGO here?</a> </h1>
    </div>

    <div class="col-md-8 mt-5 mb-2">
        <h3 class="ml-1">SIGN IN</h3>
        <p><span class="ti-key"></span> Log In to {{config('app.name')}} account</p>

        <x-auth-errors/>
        <div class="col-md-8">
            @include('includes.sessionMsg')
        </div>
        
        <form method="post" action="{{route('login')}}">
            @csrf
            <div class="col-sm-8">
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Email *">
                </div>
            </div>

            <div class="col-sm-8">
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password *">
                </div>
            </div>

            <div class="col-sm-8">
                <div class="form-group">
                    <button class="btn fl-btn" type="submit">Log In</button>
                </div>

                <div class="form-group align-right">
                    &nbsp;&nbsp; No account ? <a href="{{route('register')}}"> Create One </a>
                </div>

                <div class="form-group align-right">
                    &nbsp;&nbsp; Forgot Password? <a href="{{route('forgot-password')}}"> Reset </a>
                </div>
            </div>
        </form>
    </div>

</div>

@endsection