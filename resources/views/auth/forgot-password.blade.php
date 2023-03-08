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
                <h3 class="ml-1" style="font-family: 'Times New Roman', Times, serif;">FORGOT PASSWORD ?</h3>
                <p><span class="ti-lock"></span> Change your {{ config('app.name') }} account password</p>
            </div>
            <x-auth-errors />

            <div class="col-md-8">
                @include('includes.sessionMsg')
            </div>

            <form method="post" action="{{ route('forgot-password') }}">
                @csrf
                <div class="">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email *">
                    </div>
                </div>

                <div class="">
                    <div class="form-group">
                        <button class="btn fl-btn" type="submit">Submit</button>
                    </div>

                </div>
            </form>
        </div>

    </div>
@endsection
