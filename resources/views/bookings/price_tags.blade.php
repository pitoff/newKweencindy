@extends('layouts.layout')
@section('pageContent')

<section id="services" class="section-padding bg-grey" data-scroll-index="2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title mb-30"> 
                    <h4>Our Price Tags</h4>
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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $key => $cat)
                            <tr>
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$cat->category}}</td>
                                <td>{{$cat->description}}</td>
                                <td>&#8358;{{number_format($cat->price, 2)}}</td>
                            </tr>
                            @empty
                                <h5><em>No available categories</em></h5>
                            @endforelse
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection