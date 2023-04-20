@extends('layouts.layout')
@section('pageContent')
    <!-- Services -->
    @if (admin())
        <section id="services" class="section-padding bg-grey" data-scroll-index="2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title mb-30">
                            <h3> My Dashboard</h3>
                            <hr class="line line-hr-secondary">
                            <p>{{ ucfirst(auth()->user()->email) }} Welcome to {{ config('app.name') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row services">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-4">
                                <a href="{{route('users')}}" class="btn">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Users</h5>
                                            <p class="card-text"> View all registered system users.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a href="{{ route('already_booked') }}" class="btn">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">All Booking</h5>
                                            <p class="card-text">View already booked and accepted dates.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a href="{{ route('create_booking') }}" class="btn">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Book A Session</h5>
                                            <p class="card-text">Book and secure a make up session.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-4">
                                <a href="#" class="btn">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Gallery</h5>
                                            <p class="card-text">Add make up photos to gallery.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a href="{{ route('categories.index') }}" class="btn">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Category</h5>
                                            <p class="card-text">Create make up categories and prices.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a href="{{ route('payment.index') }}" class="btn">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Payment Method</h5>
                                            <p class="card-text">Create {{ config('app.name') }} payment method.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="row">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right mt-5"> <a class="underline-text" href="{{ route('dashboard') }}">
                            Dashboard <i class="ti-arrow-right"></i></a> </div>
                </div>
            </div>
        </section>
    @else
        <section id="services" class="section-padding bg-grey" data-scroll-index="2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title mb-30">
                            <h3> My Dashboard</h3>
                            <hr class="line line-hr-secondary">
                            <p>{{ ucfirst(auth()->user()->email) }} Welcome to {{ config('app.name') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row services">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-4">
                                <a href="{{ route('already_booked') }}" class="btn">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">All Booking</h5>
                                            <p class="card-text">View already booked and accepted dates.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a href="{{ route('create_booking') }}" class="btn">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Book A Session</h5>
                                            <p class="card-text">Book a date and secure a make up session.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a href="{{ route('my_booking', auth()->user()->id) }}" class="btn">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">My Booking</h5>
                                            <p class="card-text">View make up sessions you have booked.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-4">
                                <a href="{{ route('priceTags') }}" class="btn">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Gallery</h5>
                                            <p class="card-text">See our works on our gallery.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a href="{{ route('priceTags') }}" class="btn">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Price Tags</h5>
                                            <p class="card-text">View Price tags for each type of make up.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right mt-5"> <a class="underline-text" href="{{ route('dashboard') }}">
                            Dashboard <i class="ti-arrow-right"></i></a> </div>
                </div>
            </div>
        </section>
    @endif
@endsection
