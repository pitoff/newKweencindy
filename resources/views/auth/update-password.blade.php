@extends('layouts.auth')
@section('pageContent')

<div class="row">

    <div class="col-md-4" style="margin:auto;">
        <h1> <a href="/">BBKC LOGO here?</a> </h1>
    </div>

    <div class="col-md-8 mt-5 mb-2">
        <h3 class="ml-1">RESET PASSWORD</h3>
        <p><span class="ti-key"></span> Change {{config('app.name')}} account password</p>

        <x-auth-errors/>
        <em class="text-danger">{{session('tokenDoesNotMatch')}}</em>
        <form action="{{route('reset-password', [$passwordToken, $email])}}" method="POST">
            @csrf @method('PUT')
            <div class="col-sm-8">
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password *">
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Retype-assword *">
                </div>
            </div>

            <div class="col-sm-8">
                <div class="form-group">
                    <button class="btn fl-btn" type="submit">Change Password</button>
                </div>
            </div>
        </form>
    </div>

</div>

@endsection