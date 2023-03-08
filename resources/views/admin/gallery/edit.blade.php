@extends('layouts.layout')
@section('pageContent')

<section id="services" class="section-padding bg-grey" data-scroll-index="2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title mb-30">
                    <h4>Edit Image</h4>
                    <hr class="line line-hr-secondary">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4 gallery-item">
                    <a href="{{asset('imageGallery/'.$image->imageFile)}}" title="{{$image->imageName}}" class="img-zoom">
                        <div class="gallery-box">
                            <div class="gallery-img"> <img src="{{asset('imageGallery/'.$image->imageFile)}}" class="img-fluid mx-auto d-block" alt="" style="height:280; width:100%;"> </div>
                            <div class="gallery-detail text-center"> <i class="ti-plus"></i> </div>
                        </div>
                    </a>
                </div>
                <x-auth-errors />
                <form method="post" action="{{route('image-gallery.update', $image->id)}}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="">
                        <div class="form-group">
                            <input type="text" class="form-control" name="imageName" value="{{$image->imageName}}">
                        </div>
                    </div>
                    <div class="">
                        <div class="form-group">
                            <input type="text" class="form-control" name="description" value="{{$image->description}}">

                        </div>
                    </div>

                    <div class="">
                        <div class="form-group">
                            <input type="file" class="form-control" name="imageFile" placeholder="Image File *">
                        </div>
                    </div>

                    <div class="">
                        <div class="form-group">
                            <button class="btn fl-btn" type="submit">Update</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
</section>

@endsection