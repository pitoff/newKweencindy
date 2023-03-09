@extends('layouts.layout')
@section('pageContent')

<section id="services" class="section-padding bg-grey" data-scroll-index="2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title mb-30"> 
                    <h3>My Bookings</h3>
                    <hr class="line line-hr-secondary">
                </div>
                    @include('includes.sessionMsg')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{-- <h5>Dates you have booked</h5> --}}
                <div class="text-right">
                    <a href="{{ route('create_booking') }}" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
                        <strong><em>Click here to Book Session</em></strong> </a>
                </div>
            
                <!-- start section for user to see dates he has booked -->

                <div class="categories-table table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category</th>
                                <th scope="col">Price</th>
                                <th scope="col">Date</th>
                                <th scope="col">State</th>
                                <th scope="col">Town</th>
                                <th scope="col">Address</th>
                                <th scope="col" colspan="2" class="text-center">Payment</th>
                                <th scope="col" colspan="2" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($booked as $key => $book)

                            <tr>
                                <td>{{ ($booked->currentpage()-1) * $booked->perpage() + (1+$key ++) }}</td>
                                {{-- <td>{{$key + 1}}</td> --}}
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

                                @if($book->book_status == 1)
                                    @if ($book->payment_status == 1)
                                        <td><em>Awaiting confirmation</em></td>
                                    @elseif($book->payment_status == 2)
                                        <td><em>Payment Received</em></td>
                                    @else
                                        <td>
                                            <button type="button" class="btn-sm btn-success" id="markAsPaidBtn" data-id="{{$book->id}}" data-toggle="modal" data-target="#markAsPaidModal{{$book->id}}"> <span class="ti-">Mark as Paid</span> </button>
                                        
                                            <!-- modal to confirm that user has made payment -->
                                            <form method="post" action="{{route('userMarkPaid', $book->id)}}">
                                            @csrf @method('PUT')
                                            <div class="modal fade" id="markAsPaidModal{{$book->id}}" style="position: absolute;" tabindex="-1" aria-labelledby="markAsPaidModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="markAsPaidModalLabel">Payment Made</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="font-size: large;">You are notifying the system that you have made payment, are you sure of this {{$book->id}}?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn-success">Yes <span class="ti-check"></span></button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            </form>
                                            <!-- end modal -->
                                        
                                        </td>
                                    @endif
                                    <td>
                                        <a href="{{route('payment_details', $book->id)}}"><button type="button" class="btn-sm btn-info"><span class="ti-">Make Payment</span></button></a>
                                    </td>
                                @else
                                    <td colspan="2">Not yet accepted</td>
                                @endif
                                
                                @if($book->book_status == 0)
                                    <td>
                                        <a href="{{route('edit_booking', $book->id)}}"><button type="button" class="btn-sm btn-warning"><span class="ti-pencil">Edit</span></button></a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn-sm btn-danger" id="removeBtn" data-id="{{$book->id}}" data-toggle="modal" data-target="#exampleModal"> <span class="ti-trash"></span> </button>
                                    </td>
                                @elseif($book->book_status == 1)
                                    <td colspan="2"></td>
                                @endif
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

                <!-- end start section for user to see dates he has booked -->

                <div class="mt-2">
                    {{$booked->links()}}
                </div>
                <a href="{{route('already_booked')}}" class="btn fl-btn" type="submit">Already Booked</a>
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

    })
</script>