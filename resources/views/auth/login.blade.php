@extends('layouts.auth')
@section('pageContent')
    <div class="container-fluid">

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
                    <h3 class="ml-1" style="font-family: 'Times New Roman', Times, serif;"> SIGN IN</h3>
                    <p><span class="ti-key "></span> Log In to {{ config('app.name') }} account</p>
                </div>

                <x-auth-errors />
                <div class="">
                    @include('includes.sessionMsg')
                </div>

                <form method="post" action="{{ route('login') }}">
                    @csrf
                    <div class="">
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="Email *">
                        </div>
                    </div>

                    <div class="">
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password *">
                        </div>
                    </div>

                    <div class="">
                        <div class="form-group">
                            <button class="btn fl-btn" type="submit">Log In</button>
                        </div>

                        <div class="form-group align-right">
                            &nbsp;&nbsp; No account ? <a href="{{ route('register') }}"> Create One </a>
                        </div>

                        <div class="form-group align-right">
                            &nbsp;&nbsp; Forgot Password? <a href="{{ route('forgot-password') }}"> Reset </a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
