@extends('layouts.layout')
@section('pageContent')
    <section id="services" class="section-padding bg-grey" data-scroll-index="2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title mb-30">
                        <h4>Gallery</h4>
                        <hr class="line line-hr-secondary">
                    </div>
                </div>
            </div>

            @if (admin())
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="align-left">
                            <a href="{{ route('image-gallery.create') }}" class="btn-secondary btn-sm" type="button"> <span
                                    class="ti-plus"></span> Add Image </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @include('includes.sessionMsg')
                    </div>
                </div>
            @endif

            <div class="row">
                @forelse ($images as $image)
                    <div class="col-md-4">
                        <div class="post-img">
                            <div class="">
                                <a href="{{ asset('imageGallery/' . $image->imageFile) }}" title="{{ $image->imageName }}"
                                    class="img-zoom">
                                    <div class="gallery-box">
                                        <div class="gallery-img"> <img
                                                src="{{ asset('imageGallery/' . $image->imageFile) }}"
                                                class="img-fluid mx-auto d-block" alt=""
                                                style="width: 100%; height:250px;"> </div>
                                        <div class="gallery-detail text-center"> <i class="ti-plus"></i> </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="post-cont">
                            <h5 style="font-size:15px; margin-bottom:0px !important;"> <a
                                    href="#">{{ $image->imageName }}</a> </h5>
                            <p>{{ $image->description }}</p>
                            <div class="pr-5">
                                <a href="{{ asset('imageGallery/' . $image->imageFile) }}" target="__blank"><button
                                        type="button" class="btn-success btn-sm"> <span class="ti-eye"
                                            style="color:white;"></span> </button></a>
                                @if (admin())
                                    <a href="{{ route('image-gallery.edit', $image->id) }}"><button type="button"
                                            class="btn-info btn-sm"> <span class="ti-arrow-up" style="color:white;"></span>
                                        </button></a>
                                    <button type="button" class="btn-danger btn-sm" data-toggle="modal" id="removeImage"
                                        data-target="#deleteModal" data-id="{{ $image->id }}"> <span class="ti-trash"
                                            style="color:white;"></span>
                                    </button>
                                @endif

                            </div>
                        </div>

                    </div>
                @empty
                    <em>
                        <h4>No image uploaded to gallery</h4>
                    </em>
                @endforelse

            </div>

            <div class="row mt-5">
                <div class="col-md-12">
                    {{ $images->links() }}
                </div>
            </div>

        </div>
    </section>

    <!-- delete image -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Remove Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: large;">Please confirm you want to delete image from gallery
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="deleteImage" class="btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end delete image -->

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>

    <script>
        $(function() {
            $(document).on('click', '#removeImage', function(e) {
                let id = $(this).attr('data-id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })

                $(document).on('click', '#deleteImage', function(e) {
                    e.preventDefault();
                    // console.log("image id", id)
                    $.ajax({
                        type: "DELETE",
                        url: `/image-gallery/${id}`,
                        success: function(response) {
                            location.reload(true)
                        }
                    });
                })
            });
        })
    </script>
    
@endsection
