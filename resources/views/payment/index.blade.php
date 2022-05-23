@extends('layouts.layout')
@section('pageContent')

<section id="services" class="section-padding bg-grey" data-scroll-index="2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title mb-30"> <span></span>
                    <h5>Payment Method</h5>
                    <hr class="line line-hr-secondary">
                </div>
            </div>
        </div>
        <div class="row">
            @if (Session::has('error'))
            <div class="col-md-8 alert alert-danger alert-dismissible fade show" role="alert">
                {{Session::get('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if (Session::has('success'))
            <div class="col-md-8 alert alert-success alert-dismissible fade show" role="alert">
                {{Session::get('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="col-md-8 offset-2">
                <!-- <h5>Payment methods</h5> -->

                <div class="align-left mb-3">
                    <a href="{{route('payment.create')}}" class="btn-secondary btn-sm" type="submit"> <span class="ti-plus"></span> Add method</a>
                </div>

                <div class="categories-table table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Bank</th>
                                <th scope="col">Acc No.</th>
                                <th scope="col">Acc Name</th>
                                <th scope="col">Status</th>
                                <th scope="col" colspan="3" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payment as $key => $p)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$p->bank}}</td>
                                <td>{{$p->acc_number}}</td>
                                <td>{{$p->acc_name}}</td>
                                <td>{{$p->is_active}}</td>
                                <td>
                                    @if ($p->is_active == 0)
                                    <form method="POST" action="{{route('paymentActivate', $p->id)}}">
                                        @csrf @method('PUT')
                                        <button type="submit" class="btn-sm btn-info"><span class="">Activate</span></button>
                                    </form>
                                    @else
                                    <form method="POST" action="{{route('paymentDeactivate', $p->id)}}">
                                        @csrf @method('PUT')
                                        <button type="submit" class="btn-sm btn-danger"><span class="">Dectivate</span></button>
                                    </form>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('payment.edit', $p->id)}}"><button type="button" class="btn-sm btn-success"><span class="ti-pencil">Edit</span></button></a>
                                </td>
                                <td>
                                    <button type="button" class="btn-sm btn-danger" id="removeBtn" data-toggle="modal" data-target="#exampleModal{{$p->id}}"> <span class="ti-trash"></span> </button>

                                    
                                </td>
                            </tr>

                            <!--Delete Payment Modal -->
                            <div class="modal fade" id="exampleModal{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Remove Payment Method</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p style="font-size: large;">Are you sure you want to delete this payment method?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" form="removeMethod" class="btn-danger">Delete</button>
                                        </div>
                                        <form action="{{route('payment.destroy', $p->id)}}" id="removeMethod" method="post">
                                            @csrf @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end Delete modal -->

                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection