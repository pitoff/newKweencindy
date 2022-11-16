@extends('layouts.layout')
@section('pageContent')

    <section id="services" class="section-padding bg-grey" data-scroll-index="2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title mb-30"> <span>bookings</span>
                        <h4>All Bookings</h4>
                        <hr class="line line-hr-secondary">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    @include('includes.sessionMsg')
                </div>
                <div class="col-md-12">
                   
                        <h5>All booked and accepted</h5>

                        <div class="text-right">
                            <a href="{{ route('create_booking') }}" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
                                <strong><em>Click here to Book Session</em></strong> </a>
                        </div>
                    

                    <!-- section for user to see all booking made -->
                    
                        <div class="categories-table table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">State</th>
                                        <th scope="col">Town</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Date Booked</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $key = 0 @endphp
                                    @forelse ($bookings as $book)
                                        @if ($book->payment_status == 2)
                                            <tr>
                                                <td>{{ ($bookings->currentpage()-1) * $bookings->perpage() + (1+$key ++) }}</td>
                                                {{-- <td>{{ $key++ }}</td> --}}
                                                <td>{{ $book->category->category }}</td>
                                                <td>#{{ number_format($book->category->price, 2) }}</td>
                                                @if ($book->location === 'personal location')
                                                    <td>{{ $book->state }}</td>
                                                    <td>{{ $book->town }}</td>
                                                    <td>{{ $book->address }}</td>
                                                @else
                                                    {{-- ($book->location === 'office') --}}
                                                    <td colspan="3" class="text-center">Office location</td>
                                                @endif
                                                <td>
                                                    {{ $book->book_date }}
                                                </td>

                                            </tr>
                                        @endif
                                    @empty
                                        <div class="alert alert-warning">No booked dates found</div>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    
                    <!-- end section for user to see all booking made -->

                    <div class="col-md-4 mt-2">
                        {{ $bookings->links() }}
                    </div>
                    <a href="{{ route('my_booking', auth()->user()->id) }}" class="btn fl-btn" type="submit">GoTo My
                        Bookings</a>

                </div>
            </div>

        </div>
    </section>

@endsection