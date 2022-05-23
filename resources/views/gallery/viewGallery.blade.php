@extends('layouts.layout')
@section('pageContent')

<section id="services" class="section-padding bg-grey" data-scroll-index="2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title mb-30"> <span></span>
                    <h4>{{config('app.name')}} Gallery</h4>
                    <hr class="line line-hr-secondary">
                </div>
            </div>
        </div>
        <div class="row">
            

            <div class="col-md-8 offset-2">
                <!-- <h5>Payment methods</h5> -->

                <div class="align-left mb-3">
                    <a href="{{route('image-gallery.create')}}" class="btn-secondary btn-sm" type="button"> <span class="ti-plus"></span> Add Image to gallery</a>
                </div>

                
            </div>
        </div>

    </div>
</section>

@endsection