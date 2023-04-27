@extends('layouts.layout')
@section('pageContent')
    <section id="services" class="section-padding bg-grey" data-scroll-index="2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title mb-30">
                        <h3>Bookings For {{ucfirst($user)}}</h3>
                        <hr class="line line-hr-secondary">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('includes.sessionMsg')
                    <div class="text-right">

                    </div>

                    <div class="categories-table table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Percent</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $key = 0 @endphp
                                @forelse ($userBookings as $booking)
                                    <tr>
                                        <td>{{ ($userBookings->currentpage() - 1) * $userBookings->perpage() + (1 + $key++) }}</td>
                                        <td>{{ $booking->category->category }}</td>
                                        <td>#{{ number_format($booking->category->price, 2) }}</td>
                                        <td>{{ $booking->book_date }}</td>
                                        <td>
                                            @if ($booking->discount !== null)
                                                {{$booking->discount->discount_percentage}}%
                                            @else
                                                {{"No Discount"}}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($booking->discount !== null)
                                            &#8358; {{number_format($booking->discount->discounted_price)}}
                                            @else
                                                {{"No Discount"}}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('createDiscount', [$booking->id])}}" class="btn-sm btn-info">
                                                Apply Discount
                                            </a>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="alert alert-warning text-center" colspan="10">
                                            No booking found
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                    <div class="mt-2">
                        {{ $userBookings->links() }}
                    </div>

                    <a href="{{ route('users') }}" class="btn fl-btn" type="submit">Users</a>

                </div>
            </div>

        </div>
    </section>
@endsection
