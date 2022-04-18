@extends('layouts.layout')
@section('pageContent')

<section id="services" class="section-padding bg-grey" data-scroll-index="2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title mb-30"> <span>booking</span>
                    <h2>Create booking</h2>
                    <hr class="line line-hr-secondary">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-2">
                <h3 class="ml-1">Book session</h3>

                <form method="post" action="">
                    @include('bookings.booking_form')
                </form>
            </div>
        </div>

    </div>
</section>

@endsection