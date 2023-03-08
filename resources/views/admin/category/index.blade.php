@extends('layouts.layout')
@section('pageContent')

<section id="services" class="section-padding bg-grey" data-scroll-index="2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title mb-30"> 
                    {{-- <span>categories</span> --}}
                    <h4>Makeup Categories</h4>
                    <hr class="line line-hr-secondary">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="categories-table table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category</th>
                                <th scope="col">Description</th>
                                <th scope="col">Price</th>
                                <th scope="col" colspan="2" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $key => $cat)
                            <tr>
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$cat->category}}</td>
                                <td>{{$cat->description}}</td>
                                <td>&#8358;{{number_format($cat->price, 2)}}</td>
                                <td>
                                    <a href="{{route('categories.edit', $cat->id)}}"><button type="button" class="btn-sm btn-success"><span class="ti-pencil">Edit</span></button></a>
                                </td>
                                <td>
                                    <form action="{{route('categories.destroy', $cat->id)}}" method="post">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-sm btn-danger"> <span class="ti-trash"></span> </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <h5><em>No available categories</em></h5>
                            @endforelse
                            
                        </tbody>
                    </table>
                </div>
                <a href="{{route('categories.create')}}" class="btn fl-btn" type="submit">Add Category</a>
            </div>
        </div>

    </div>
</section>

@endsection