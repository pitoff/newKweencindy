@extends('layouts.layout')
@section('pageContent')

<section id="services" class="section-padding bg-grey" data-scroll-index="2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title mb-30"> 
                    <h3>Edit Category</h3>
                    <hr class="line line-hr-secondary">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{route('categories.update', $category->id)}}">
                    @method('PUT')
                    @include('admin.category.category_form')
                </form>
            </div>
        </div>

    </div>
</section>

@endsection