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
                <h3 class="ml-1" style="font-family: 'Times New Roman', Times, serif;">SIGN UP</h3>
                <p><span class="ti-pencil"></span> Create an account with {{ config('app.name') }}</p>
            </div>

            <x-auth-errors />
            <div class="">
                @include('includes.sessionMsg')
            </div>
            <form method="post" action="{{ route('register') }}">
                @csrf
                <div class="">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                            placeholder="Name *">
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}"
                            placeholder="Email *">
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" value="{{ old('phone') }}"
                            placeholder="Phone *">
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <input type="text" class="form-control" name="address" value="{{ old('address') }}"
                            placeholder="Address *">
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password *">
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <input type="password" class="form-control" name="password_confirmation"
                            placeholder="Retype Password *">
                    </div>
                </div>

                <div class="">
                    <div class="form-group">
                        <button class="btn fl-btn" type="submit">Register</button>
                    </div>

                    <div class="form-group align-right">
                        &nbsp;&nbsp; Already have account ? <a href="{{ route('login') }}"> Login </a>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
