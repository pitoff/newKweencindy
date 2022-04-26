@extends('layouts.layout')
@section('pageContent')

<!-- Services -->
@if (auth()->user()->is_admin)

<section id="services" class="section-padding bg-grey" data-scroll-index="2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title mb-30"> <span>book for</span>
                    <h2>Makeup Services</h2>
                    <hr class="line line-hr-secondary">
                </div>
            </div>
        </div>
        <div class="row services">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Already Booked</h5>
                                <p class="card-text">View already booked and accepted make up dates.</p>
                                <a href="#" class="btn"> <span class="ti-eye"></span> See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Book A Session</h5>
                                <p class="card-text">Click below to proceed to book and secure a make up session.</p>
                                <a href="{{route('create_booking')}}" class="btn">Book</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">My Bookings</h5>
                                <p class="card-text">Want to view make up sessions you have booked with {{config('app.name')}}.</p>
                                <a href="{{route('my_booking', auth()->user()->id)}}" class="btn">View Bookings</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Category</h5>
                                <p class="card-text">Create make up categories and their respective price tags</p>
                                <a href="{{route('categories.index')}}" class="btn">Click to Create</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-right mt-5"> <a class="underline-text" href="{{route('dashboard')}}"> Dashboard <i class="ti-arrow-right"></i></a> </div>
        </div>
    </div>
</section>

@else
    
<section id="services" class="section-padding bg-grey" data-scroll-index="2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title mb-30"> <span>book for</span>
                    <h2>Makeup Services</h2>
                    <hr class="line line-hr-secondary">
                </div>
            </div>
        </div>
        <div class="row services">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Already Booked</h5>
                                <p class="card-text">View already booked and accepted make up dates.</p>
                                <a href="#" class="btn"> <span class="ti-eye"></span> See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Book A Session</h5>
                                <p class="card-text">Click below to proceed to book and secure a make up session.</p>
                                <a href="{{route('create_booking')}}" class="btn">Book</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">My Bookings</h5>
                                <p class="card-text">Want to view make up sessions you have booked with {{config('app.name')}}.</p>
                                <a href="{{route('my_booking', auth()->user()->id)}}" class="btn">View Bookings</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-2">
                    <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Price Tags</h5>
                                <p class="card-text">View Price tags for each type of make up session you book.</p>
                                <a href="#" class="btn">Click to preview</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-right mt-5"> <a class="underline-text" href="{{route('dashboard')}}"> Dashboard <i class="ti-arrow-right"></i></a> </div>
        </div>
    </div>
</section>


@endif

@endsection