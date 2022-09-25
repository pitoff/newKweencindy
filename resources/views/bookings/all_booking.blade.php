@extends('layouts.layout')
@section('pageContent')

    <style>
        .blink {
            animation: blinker 1s linear infinite;
        }

        @keyframes blinker {
            50% {
                opacity: 0;
            }
        }
    </style>
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
                    @if (auth()->user()->is_admin)
                    
                        <div class="text-left">
                            <h5>All booked appointment</h5>
                        </div>

                        <div class="text-right">
                        <a href="{{ route('create_booking') }}" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
                            <strong><em>Click here to Book Session</em></strong> </a>
                        </div>
                    @else
                        <h5>All booked and accepted</h5>

                        <div class="text-right">
                            <a href="{{ route('create_booking') }}" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
                                <strong><em>Click here to Book Session</em></strong> </a>
                        </div>
                    @endif

                    <!-- section for admin to see all booking made -->
                    @if (auth()->user()->is_admin)
                        <div class="categories-table table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Date Booked</th>
                                        <th scope="col">State</th>
                                        <th scope="col">Town</th>
                                        <th scope="col">Address</th>
                                        <th scope="col" colspan="2">Payment</th>
                                        <th scope="col">Accept/Decline</th>
                                        <th scope="col" colspan="3" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bookings as $key => $book)
                                        <tr>
                                            <td>{{ ($bookings->currentpage()-1) * $bookings->perpage() + (1+$key ++) }}</td>
                                            <td>{{$book->user->email}}</td>
                                            {{-- <td>{{ $key + 1 }}</td> --}}
                                            <td>{{ $book->category->category }}</td>
                                            <td>#{{ number_format($book->category->price, 2) }}</td>
                                            <td>{{ $book->book_date }}</td>
                                            @if ($book->location === 'personal location')
                                                <td>{{ $book->state }}</td>
                                                <td>{{ $book->town }}</td>
                                                <td>{{ $book->address }}</td>
                                            @else
                                                <td colspan="3" class="text-center">Office location</td>
                                            @endif

                                            @if ($book->payment_status === 2)
                                                <td><em>Received</em></td>
                                                <td>
                                                    <button type="button" class="btn-sm btn-info" id="markNotReceivedBtn"
                                                        data-id="{{ $book->id }}" data-toggle="modal"
                                                        data-target="#markNotReceivedModal{{ $book->id }}">
                                                        <span class="ti-">Mark not Received</span>

                                                    </button>

                                                    <!-- modal to mark as not received -->
                                                    <form method="post"
                                                        action="{{ route('adminMarkNotReceived', $book->id) }}">
                                                        @csrf @method('PUT')
                                                        <div class="modal fade"
                                                            id="markNotReceivedModal{{ $book->id }}" tabindex="-1"
                                                            aria-labelledby="markNotReceivedModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="markNotReceivedModal">
                                                                            Mark payment as not received</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p style="font-size: large;">You want to mark
                                                                            payment for {{ $book->book_date }} as not
                                                                            received?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn-secondary"
                                                                            data-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="btn-success">Yes <span
                                                                                class="ti-check"></span></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- end modal -->
                                                </td>
                                            @else
                                                <td>
                                                    <button type="button" class="btn-sm btn-info" id="markAsReceivedBtn"
                                                        data-id="{{ $book->id }}" data-toggle="modal"
                                                        data-target="#markAsReceivedModal{{ $book->id }}">
                                                        <span class="ti-">Mark as Received</span>
                                                        @if ($book->payment_status === 1)
                                                            <div class="blink"><span class="badge badge-danger">!</span>
                                                            </div>
                                                        @endif
                                                    </button>

                                                    <!-- modal to mark as received -->
                                                    <form method="post"
                                                        action="{{ route('adminMarkReceived', $book->id) }}">
                                                        @csrf @method('PUT')
                                                        <div class="modal fade" id="markAsReceivedModal{{ $book->id }}"
                                                            tabindex="-1" aria-labelledby="markAsReceivedModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="markAsReceivedModal">
                                                                            Mark payment as received</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p style="font-size: large;">You want to confirm the
                                                                            payment for {{ $book->book_date }} as received?
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn-secondary"
                                                                            data-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="btn-success">Yes <span
                                                                                class="ti-check"></span></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- end modal -->

                                                </td>

                                                <td>

                                                    <button type="button" class="btn-sm btn-info" id="markNotReceivedBtn"
                                                        data-id="{{ $book->id }}" data-toggle="modal"
                                                        data-target="#markNotReceivedModal{{ $book->id }}">
                                                        <span class="ti-">Mark not Received</span>

                                                    </button>

                                                    <!-- modal to mark as not received -->
                                                    <form method="post"
                                                        action="{{ route('adminMarkNotReceived', $book->id) }}">
                                                        @csrf @method('PUT')
                                                        <div class="modal fade"
                                                            id="markNotReceivedModal{{ $book->id }}" tabindex="-1"
                                                            aria-labelledby="markNotReceivedModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="markNotReceivedModal">
                                                                            Mark payment as not received</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p style="font-size: large;">You want to mark
                                                                            payment for {{ $book->book_date }} as not
                                                                            received?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn-secondary"
                                                                            data-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="btn-success">Yes
                                                                            <span class="ti-check"></span></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- end modal -->

                                                </td>
                                            @endif

                                            <td>
                                                @if ($book->book_status == 0)
                                                    <button type="button" id="acceptBtn" class="btn-sm btn-success"
                                                        data-date="{{ $book->book_date }}" data-id="{{ $book->id }}"
                                                        data-toggle="modal" data-target="#acceptModal">Accept</button>
                                                @elseif ($book->book_status == 1)
                                                    <button type="button" id="declineBtn" class="btn-sm btn-danger"
                                                        data-date="{{ $book->book_date }}" data-id="{{ $book->id }}"
                                                        data-toggle="modal" data-target="#declineModal">Decline</button>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" id="viewBooking" class="btn-sm btn-primary"
                                                    data-date="{{ $book->book_date }}" data-id="{{ $book->id }}"
                                                    data-toggle="modal" data-target="#viewBookModal"> <span
                                                        class="ti-eye"></span></button>
                                            </td>
                                            <td>
                                                <a href="{{ route('edit_booking', $book->id) }}"><button type="button"
                                                        class="btn-sm btn-warning"><span
                                                            class="ti-pencil">Edit</span></button></a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn-sm btn-danger" id="removeBtn"
                                                    data-id="{{ $book->id }}" data-toggle="modal"
                                                    data-target="#exampleModal"> <span class="ti-trash"></span> </button>

                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-warning">No booked dates found</div>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                        <!-- end section for admin to see all booking made -->

                    <!-- section for user to see all booking made -->
                    @else
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
                    @endif
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Booked Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: large;">Are you sure you want to delete already booked make up appointment?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="removeBooking" class="btn-success">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->

    <!-- accept booking -->
    <div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="acceptModalLabel">Accept Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: large;">You are about to accept this booking date for <span
                            id="dateFor"></span> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="acceptBooking" class="btn-success">Accept</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end accept booking -->

    <!-- decline booking -->
    <div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="declineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="declineModalLabel">Decline Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: large;">You are about to decline this booking date for <span
                            id="declinedateFor"></span> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="declineBooking" class="btn-danger">Decline</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end decline booking -->

    <!-- view booking -->
    <div class="modal fade" id="viewBookModal" tabindex="-1" aria-labelledby="viewBookModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-center" id="viewBookModalLabel">Booking For <span
                            class="viewDateFor"></span> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: large;">Name: <span class="name"></span> </p>
                    <p style="font-size: large;">Email: <span class="email"></span> </p>
                    <p style="font-size: large;">Phone No.: <span class="phone"></span> </p>
                    <p style="font-size: large;">Category: <span class="category"></span> </p>
                    <div class="locationDetails">
                        <p style="font-size: large;">State: <span class="state"></span> </p>
                        <p style="font-size: large;">Town: <span class="town"></span> </p>
                        <p style="font-size: large;">Address: <span class="address"></span> </p>
                    </div>
                    <p style="font-size: large;">Location: <span class="location"></span> </p>
                    <p style="font-size: large;">Book Status: <span class="bookStatus"></span> </p>
                    <p style="font-size: large;">Payment Status: <span class="payStatus"></span> </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end view booking -->

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
<script>
    $(function() {
        $(document).on('click', '#removeBtn', function() {
            let id = $(this).attr('data-id');
            console.log(id)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $(document).on('click', '#removeBooking', function(e) {
                e.preventDefault()
                $.ajax({
                    type: "DELETE",
                    url: `/booking/remove/${id}`,
                    success: function(response) {
                        jQuery('exampleModal').modal('hide')
                        // console.log(response.message)
                        location.reload(true)
                    }
                });
            })

        })

        $(document).on('click', '#acceptBtn', function() {
            let bookDate = $(this).attr('data-date');
            let id = $(this).attr('data-id');
            $('#dateFor').text(bookDate);
            // console.log(id + bookDate)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $(document).on('click', '#acceptBooking', function(e) {
                e.preventDefault()
                $.ajax({
                    type: "PUT",
                    url: `/admin/accept-booking/${id}`,
                    success: function(response) {
                        console.log(response.message)
                        // jQuery('#acceptModal').modal('hide')

                        location.reload(true)
                        // $('.alert-success').text(response.message)

                    }
                });
            })

        })

        $(document).on('click', '#declineBtn', function() {
            let bookDate = $(this).attr('data-date');
            let id = $(this).attr('data-id');
            $('#declinedateFor').text(bookDate);
            // console.log(id + bookDate)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $(document).on('click', '#declineBooking', function(e) {
                e.preventDefault()
                $.ajax({
                    type: "PUT",
                    url: `/admin/decline-booking/${id}`,
                    success: function(response) {
                        console.log(response.message)
                        location.reload(true)
                    }
                });
            })

        })

        $(document).on('click', '#viewBooking', function() {
            let bookDate = $(this).attr('data-date');
            let id = $(this).attr('data-id');
            $('.viewDateFor').text(bookDate);

            $.ajax({
                type: "GET",
                url: `booking-preview-modal/${id}`,
                dataType: "json",
                success: function(response) {
                    $('.name').text(response.data.user.name);
                    $('.email').text(response.data.user.email);
                    $('.phone').text(response.data.user.phone);
                    $('.category').text(response.data.category.category);

                    if (response.data.location == 'office location') {
                        $('.locationDetails').hide();
                    } else {
                        $('.locationDetails').show();
                        $('.state').text(response.data.state);
                        $('.town').text(response.data.town);
                        $('.address').text(response.data.address);
                    }
                    $('.location').text(response.data.location);
                    if (response.data.book_status == 1) {
                        $('.bookStatus').text('Date accepted');
                    } else {
                        $('.bookStatus').text('Date not accepted');
                    }
                    if (response.data.payment_status == 1) {
                        $('.payStatus').text('Marked as Paid');
                    } else if (response.data.payment_status == 2) {
                        $('.payStatus').text('Marked as Received');
                    } else {
                        $('.payStatus').text('Pending');
                    }


                }
            });
        })

    })
</script>
