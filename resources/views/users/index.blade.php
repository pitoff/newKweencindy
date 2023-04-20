@extends('layouts.layout')
@section('pageContent')
    <section id="services" class="section-padding bg-grey" data-scroll-index="2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title mb-30">
                        <h3>Users</h3>
                        <hr class="line line-hr-secondary">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('includes.sessionMsg')
                    <div class="text-right">
                        {{-- <a href="{{ route('create_booking') }}"
                            style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
                            <strong><em>Click here to Book Session</em></strong> </a> --}}
                    </div>


                    <!-- section for user to see all booking made -->

                    <div class="categories-table table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Fullname</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Joined At</th>
                                    <th scope="col" colspan="3" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $key = 0 @endphp
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ ($users->currentpage() - 1) * $users->perpage() + (1 + $key++) }}</td>
                                        <td>{{ $user->fullname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->getCreatedAtAttribute($user->created_at) }}</td>
                                        <td>
                                            <a href="" class="btn-sm btn-info">
                                                Give Discount
                                            </a>
                                        </td>
                                        <td>
                                            <a href="" class="btn-sm btn-info">
                                                Edit
                                            </a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn-sm btn-danger" id="removeUser"
                                                data-id="{{ $user->id }}" data-toggle="modal" data-target="#removeUserModal">
                                                <span class="ti-">Delete</span>
                                            </button>
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
                        {{ $users->links() }}
                    </div>

                    {{-- <a href="{{ route('my_booking', auth()->user()->id) }}" class="btn fl-btn" type="submit">My
                        Bookings</a> --}}

                </div>
            </div>

        </div>
    </section>
@endsection
