@extends('layouts.layout')
@section('pageContent')

<section id="services" class="section-padding bg-grey" data-scroll-index="2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title mb-30">
                    <h4>My Bookings</h4>
                    <hr class="line line-hr-secondary">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('includes.sessionMsg')
                <div class="text-right">
                    <a href="{{ route('create_booking') }}" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
                        <strong><em>Click here to Book Session</em></strong> </a>
                </div>
                <!-- section for admin to see dates he has booked -->
                
                <div class="categories-table table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Ref No.</th>
                                <th scope="col">Category</th>
                                <th scope="col">Price</th>
                                <th scope="col">Date Booked</th>
                                <th scope="col">State</th>
                                <th scope="col">Town</th>
                                <th scope="col">Address</th>
                                <th scope="col" colspan="2" class="text-center">Payment</th>
                                <th scope="col">Accept/Decline</th>
                                <th scope="col" colspan="2" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($booked as $key => $book)

                            <tr>
                                <td>{{ ($booked->currentpage()-1) * $booked->perpage() + (1+$key ++) }}</td>
                                <td>{{$book->ref_no}}</td>
                                <td>{{$book->category->category}}</td>
                                <td>#{{number_format($book->category->price, 2)}}</td>
                                <td>{{$book->book_date}}</td>

                                @if ($book->location == 'personal location')
                                    <td>{{$book->state}}</td>
                                    <td>{{$book->town}}</td>
                                    <td>{{$book->address}}</td>
                                @else
                                    <td colspan="3" class="text-center">Office location</td>
                                @endif

                                <td>
                                    <button type="button" class="btn-sm btn-success">{{$book->payment_status}}</button>
                                </td>

                                <td>
                                    @if($book->payment_status == $awaitingConfirmation->value)
                                    <button type="button" class="btn-sm btn-info" id="markAsReceivedBtn"
                                            data-id="{{ $book->id }}" data-date="{{ $book->book_date }}" data-toggle="modal"
                                            data-target="#markAsReceivedModal">
                                                <span class="ti-">Mark as Received</span>
                                    </button>
                                    @endif
                                </td>

                                <td>
                                    @if ($book->book_status == $pendingBooking->value || $book->book_status == $bookingDeclined->value)
                                        <button type="button" id="acceptBtn" class="btn-sm btn-success" data-date="{{$book->book_date}}" data-id="{{$book->id}}" data-toggle="modal" data-target="#acceptModal">Accept</button>
                                    @elseif ($book->book_status == $bookingAccepted->value)
                                        <button type="button" id="declineBtn" class="btn-sm btn-danger" data-date="{{$book->book_date}}" data-id="{{$book->id}}" data-toggle="modal" data-target="#declineModal">Decline</button>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{route('edit_booking', $book->id)}}"><button type="button" class="btn-sm btn-warning"><span class="ti-pencil">Edit</span></button></a>
                                </td>

                                <td>
                                    <button type="button" class="btn-sm btn-danger" id="removeBtn" data-id="{{$book->id}}" data-toggle="modal" data-target="#exampleModal"> <span class="ti-trash"></span> </button>
                                </td>
                            </tr>

                            @empty
                                <tr>
                                    <td colspan="10" class="alert alert-warning text-center">
                                        No booked dates found...
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <!-- end section for admin to see dates he has booked -->

                <div class="
                {{-- col-md-4  --}}
                mt-2">
                    {{$booked->links()}}
                </div>
                <a href="{{route('already_booked')}}" class="btn fl-btn" type="submit">All Bookings</a>
            </div>
        </div>

    </div>
</section>

<!-- Modal to delete already booked appointment -->
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

<!-- accept booking modal-->
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
        <p style="font-size: large;">You are about to accept this booking date for <span id="dateFor"></span> ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="acceptBooking" class="btn-success">Accept</button>
      </div>
    </div>
  </div>
</div>
<!-- end accept booking -->

<!-- decline booking modal -->
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
        <p style="font-size: large;">You are about to decline this booking date for <span id="declinedateFor"></span> ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="declineBooking" class="btn-danger">Decline</button>
      </div>
    </div>
  </div>
</div>
<!-- end decline booking -->

<!-- Mark booking as received modal -->
<form method="post" action="{{ route('adminMarkReceived', $book->id) }}">
    @csrf @method('PUT')
    <div class="modal fade" id="markAsReceivedModal" tabindex="-1"
        aria-labelledby="markAsReceivedModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="markAsReceivedModal">
                        Mark payment as received</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: large;">You want to confirm the
                        payment for <span id="dateForMarkReceived"></span> as received?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-success" id="yesMarkReceived">Yes <span class="ti-check"></span></button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End mark booking as received modal -->

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $(function(){
        $(document).on('click', '#removeBtn', function(){
            let id = $(this).attr('data-id');
            console.log(id)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $(document).on('click', '#removeBooking', function(e){
                e.preventDefault()
                $.ajax({
                    type: "DELETE",
                    url: `/booking/remove/${id}`,
                    success: function (response) {
                        jQuery('exampleModal').modal('hide')
                        // console.log(response.message)
                        location.reload(true)
                    }
                });
            })
            
        })

        $(document).on('click', '#acceptBtn', function(){
            let bookDate = $(this).attr('data-date');
            let id = $(this).attr('data-id');
            $('#dateFor').text(bookDate);
            // console.log(id + bookDate)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $(document).on('click', '#acceptBooking', function(e){
                e.preventDefault()
                $.ajax({
                    type: "PUT",
                    url: `/admin/accept-booking/${id}`,
                    success: function (response) {
                        console.log(response.message)
                        location.reload(true)
                    }
                });
            })
            
        })

        $(document).on('click', '#declineBtn', function(){
            let bookDate = $(this).attr('data-date');
            let id = $(this).attr('data-id');
            $('#declinedateFor').text(bookDate);
            // console.log(id + bookDate)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $(document).on('click', '#declineBooking', function(e){
                e.preventDefault()
                $.ajax({
                    type: "PUT",
                    url: `/admin/decline-booking/${id}`,
                    success: function (response) {
                        console.log(response.message)
                        location.reload(true)
                    }
                });
            })
            
        })

        $(document).on('click', '#markAsReceivedBtn', function() {
            let bookDate = $(this).attr('data-date');
            let id = $(this).attr('data-id');
            $('#dateForMarkReceived').text(bookDate);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $(document).on('click', '#yesMarkReceived', function(e) {
                $('#yesMarkReceived').text("Processing...")
                e.preventDefault()
                $.ajax({
                    type: "PUT",
                    url: `/admin/mark-booking-as-received/${id}`,
                    success: function(response) {
                        $('#yesMarkReceived').text("Done")
                        console.log(response)
                        location.reload(true)
                    }
                });
            })
        })

    })
</script>