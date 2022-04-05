@extends('layouts.auth')

@section('pageContent')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>
                        {{ __('Verify Your Email Address') }}
                    </h3>
                </div>

                <div class="card-body" style="font-size: 18px; font-family:'Times New Roman', Times, serif;">
                    <!-- @if (session('message')) -->
                        <div class="alert alert-success" role="alert">
                            <!-- {{ __('A fresh verification link has been sent to your email address.') }} -->
                            {{session('message')}}
                        </div>
                    <!-- @endif -->

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
		                <button type="submit" class="btn btn-link">{{ __('click here to request another') }}</button>
	                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
