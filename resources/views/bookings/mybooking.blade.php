@extends('layouts.layout')
@section('pageContent')

<section id="services" class="section-padding bg-grey" data-scroll-index="2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title mb-30"> <span>bookings</span>
                    <h4>My Booked</h4>
                    <hr class="line line-hr-secondary">
                </div>
                @if (Session::has('success'))
                    <div class="alert-alert-success"><em>{{session('success')}}</em></div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-2">
                <h5>Dates you have booked</h5>

                <div class="categories-table table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category</th>
                                <th scope="col">Price</th>
                                <th scope="col" colspan="2" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                           
                        </tbody>
                    </table>
                </div>
                <a href="" class="btn fl-btn" type="submit">Already Booked</a>
            </div>
        </div>

    </div>
</section>

@endsection