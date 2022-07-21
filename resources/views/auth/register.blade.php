@extends('layouts.auth')
@section('pageContent')

<div class="row">

    <div class="col-md-4" style="margin:auto;">
        <h1> <a href="/">BBKC LOGO here?</a> </h1>
    </div>

    <div class="col-md-8 mt-5 mb-2">
        <h3 class="ml-1">SIGN UP</h3>
        <p><span class="ti-pencil"></span> Create an accout with {{config('app.name')}}</p>

        <x-auth-errors/>
        <div class="col-md-8">
            @include('includes.sessionMsg')
        </div>
        <form method="post" action="{{route('register')}}">
            @csrf
            <div class="col-sm-8">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Name *">
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <input type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="Email *">
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <input type="text" class="form-control" name="phone" value="{{old('phone')}}" placeholder="Phone *">
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <input type="text" class="form-control" name="address" value="{{old('address')}}" placeholder="Address *">
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password *">
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Retype Password *">
                </div>
            </div>

            <div class="col-sm-8">
                <div class="form-group">
                    <button class="btn fl-btn" type="submit">Register</button>
                </div>

                <div class="form-group align-right">
                    &nbsp;&nbsp; Already have account ? <a href="{{route('login')}}"> Login </a>
                </div>
            </div>
        </form>
    </div>

</div>

@endsection