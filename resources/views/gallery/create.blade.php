@extends('layouts.layout')
@section('pageContent')

<section id="services" class="section-padding bg-grey" data-scroll-index="2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title mb-30">
                    <h4>Upload Image to gallery</h4>
                    <hr class="line line-hr-secondary">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-2">
                <h3 class="ml-1">Upload</h3>
                <x-auth-errors/>
                <form method="post" action="{{route('image-gallery.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-sm-8">
                        <div class="form-group">
                            <input type="text" class="form-control" name="imageName" placeholder="Image name *">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <input type="text" class="form-control" name="description" placeholder="Description *">
                            
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="form-group">
                            <input type="file" class="form-control" name="imageFile" placeholder="Image File *">   
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="form-group">
                            <button class="btn fl-btn" type="submit">Save</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
</section>

@endsection