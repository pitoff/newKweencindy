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
            

            <div class="col-md-8">
                <!-- <h5>Payment methods</h5> -->

                <div class="align-left">
                    <a href="{{route('image-gallery.create')}}" class="btn-secondary btn-sm" type="button"> <span class="ti-plus"></span> Add Image to gallery</a>
                </div>

            </div>
<!-- 
            <section id="portfolio" class="section-padding" data-scroll-index="3">
            <div class="container">
                <div class="row">

                    @forelse ($images as $image)
                        <div class="col-md-4 gallery-item">
                            <a href="{{asset('imageGallery/'.$image->imageFile)}}" title="{{$image->imageName}}" class="img-zoom">
                                <div class="gallery-box">
                                    <div class="gallery-img"> <img src="{{asset('imageGallery/'.$image->imageFile)}}" class="img-fluid mx-auto d-block" alt="" style="height:200px; width:280px;"> </div>
                                    <div class="gallery-detail text-center"> <i class="ti-plus"></i> </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <em><h4>No image uploaded to gallery</h4></em>
                    @endforelse

                    <div class="col-md-4">
                        {{$images->links()}}
                    </div>
                    
                </div>
            </div>
        </section> -->

        <section id="blog" class="blog section-padding bg-grey" data-scroll-index="4">
            <div class="container">
                <div class="row">
                <!-- <div class="col-md-12"> -->
                    <!-- <div class="owl-carousel owl-theme"> -->
                    @forelse ($images as $image)
                    <div class="col-md-4 item">
                        <div class="post-img">
                            <!-- <a href="post.html"> <img src="img/blog/1.jpg" alt=""> </a> -->
                            <div class="">
                            <a href="{{asset('imageGallery/'.$image->imageFile)}}" title="{{$image->imageName}}" class="img-zoom">
                                <div class="gallery-box">
                                    <div class="gallery-img"> <img src="{{asset('imageGallery/'.$image->imageFile)}}" class="img-fluid mx-auto d-block" alt="" style="width: 100%; height:250px;"> </div>
                                    <div class="gallery-detail text-center"> <i class="ti-plus"></i> </div>
                                </div>
                            </a>
                            </div>
                        </div>
                        <div class="post-cont">
                            <h5 style="font-size:15px;"> <a href="post.html">{{$image->imageName}}</a> </h5>
                            <p>{{$image->description}}</p>
                            <div class="row">
                                <div class="pr-5">
                                    <a href="{{route('image-gallery.show', $image->id)}}"><button type="button" class="btn-success btn-sm"> <span class="ti-eye" style="color:white;"></span> </button></a>
                                    <a href="{{route('image-gallery.edit', $image->id)}}"><button type="button" class="btn-info btn-sm"> <span class="ti-arrow-up" style="color:white;"></span> </button></a>
                                    <button type="button" class="btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$image->id}}"> <span class="ti-trash" style="color:white;"></span> </button>
                                </div>
                                <div class="info">27 July 2022</div>
                            </div>
                        </div>

                    <!-- delete image -->
                    <form action="{{route('image-gallery.destroy', $image->id)}}" method="post">
                        @csrf @method('DELETE')
                        <div class="modal fade" id="deleteModal{{$image->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Remove Image</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p style="font-size: large;">You are about to delete image {{$image->id}} from gallery <span id="declinedateFor"></span> ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn-primary">Remove</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </form>
                    <!-- end delete image -->

                    </div>
                    @empty
                        <em><h4>No image uploaded to gallery</h4></em>
                    @endforelse

                    <div class="col-md-4">
                        {{$images->links()}}
                    </div>
                   
                    <!-- </div> -->
                <!-- </div> -->
                </div>
            </div>
        </section>


        </div>

    </div>
</section>

@endsection