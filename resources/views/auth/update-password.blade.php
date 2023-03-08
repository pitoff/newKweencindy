@extends('layouts.auth')
@section('pageContent')
    <div class="row">
        <div class="col-md-4 text-center" style="margin:auto;">
            <a href="/">
                <img src="{{ asset('main/img/kweencindyLogo.png') }}" alt="">
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mt-5 mb-2" style="margin:auto;">
            <div class="text-center">
                <h3 class="ml-1" style="font-family: 'Times New Roman', Times, serif;">RESET PASSWORD</h3>
                <p><span class="ti-key"></span> Change {{ config('app.name') }} account password</p>
            </div>

            <x-auth-errors />
            <div class="col-md-8">
                @include('includes.sessionMsg')
            </div>

            <form action="{{ route('updateCredentials', $passwordToken) }}" method="POST">
                @csrf
                <div class="">
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password *">
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <input type="password" class="form-control" name="password_confirmation"
                            placeholder="Retype-assword *">
                    </div>
                </div>

                <input type="hidden" value="{{ $email }}" name="email">

                <div 
                class="">
                    <div class="form-group">
                        <button class="btn fl-btn" type="submit">Change Password</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
