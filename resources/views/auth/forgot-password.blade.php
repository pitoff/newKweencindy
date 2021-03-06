@extends('layouts.auth')
@section('pageContent')

<div class="row">

    <div class="col-md-4" style="margin:auto;">
        <h1> <a href="/">BBKC LOGO here?</a> </h1>
    </div>

    <div class="col-md-8 mt-5 mb-2">
        <h3 class="ml-1">FORGOT PASSWORD ?</h3>
        <p><span class="ti-lock"></span> Change your {{config('app.name')}} account password</p>
        <x-auth-errors />
        
        <div class="col-md-8">
            @include('includes.sessionMsg')
        </div>

        <form method="post" action="{{route('forgot-password')}}">
            @csrf
            <div class="col-sm-8">
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email *">
                </div>
            </div>

            <div class="col-sm-8">
                <div class="form-group">
                    <button class="btn fl-btn" type="submit">Submit</button>
                </div>

            </div>
        </form>
    </div>

</div>

@endsection