@extends('layouts.layout')
@section('pageContent')

<!-- Services -->
<section id="services" class="section-padding bg-grey" data-scroll-index="2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title mb-30"> <span>Learn and become a pro</span>
                    <h2>Makeup Classes</h2>
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
                                <h5 class="card-title">Register for a class</h5>
                                <p class="card-text">Register for class sessions, learn and become an expert.</p>
                                <a href="#" class="btn"> Subscribe to class</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">View available class</h5>
                                <p class="card-text">See the list of classes you can subscribe to.</p>
                                <a href="#" class="btn">View</a>
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

@endsection