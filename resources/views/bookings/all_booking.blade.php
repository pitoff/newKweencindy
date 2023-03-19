@extends('layouts.layout')
@section('pageContent')
    <section id="services" class="section-padding bg-grey" data-scroll-index="2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title mb-30">
                        <h3>All Booked and Accepted Dates</h3>
                        <hr class="line line-hr-secondary">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('includes.sessionMsg')
                    <div class="text-right">
                        <a href="{{ route('create_booking') }}"
                            style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
                            <strong><em>Click here to Book Session</em></strong> </a>
                    </div>


                    <!-- section for user to see all booking made -->

                    <div class="categories-table table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Ref No.</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $key = 0 @endphp
                                @forelse ($bookings as $book)
                                    <tr>
                                        <td>{{ ($bookings->currentpage() - 1) * $bookings->perpage() + (1 + $key++) }}</td>
                                        <td>{{$book->ref_no}}</td>
                                        <td>{{ $book->category->category }}</td>
                                        <td>#{{ number_format($book->category->price, 2) }}</td>
                                        <td>
                                            {{ $book->book_date }}
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="alert alert-warning text-center" colspan="10">
                                            No booked dates found...
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                    <!-- end section for user to see all booking made -->

                    <div class="mt-2">
                        {{ $bookings->links() }}
                    </div>

                    <a href="{{ route('my_booking', auth()->user()->id) }}" class="btn fl-btn" type="submit">My
                        Bookings</a>

                </div>
            </div>

        </div>
    </section>
@endsection
