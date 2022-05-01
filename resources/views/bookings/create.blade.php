@extends('layouts.layout')
@section('pageContent')

<section id="services" class="section-padding bg-grey" data-scroll-index="2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title mb-30"> <span>booking</span>
                    <h2>Create booking</h2>
                    <hr class="line line-hr-secondary">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-2">
                <h3 class="ml-1">Book session</h3>
                <x-auth-errors />
                <form method="post" action="{{route('create_booking')}}">
                    @include('bookings.booking_form')
                </form>
            </div>
        </div>

    </div>
</section>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('#locationInfo').hide()
        $('#categoryInfo').hide()

        $('#category').change(function(){
            let catId = $(this).val()
            $.ajax({
                type: "GET",
                url: `/booking-categories/${catId}`,
                dataType: "json",
                success: function (response) {
                    $('#categoryInfo').show()
                    $('#description').val(response.data.description)
                    let price = $('#price').val(response.data.price)
                }
            });
        })

        $('#location').change(function(){
            let location = $(this).val()
            if(location == 'personal location'){
                $('#locationInfo').show()
            }else if(location == 'office'){
                $('#locationInfo').hide()
            }

            
        })
    })
</script>