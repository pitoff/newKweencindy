@extends('layouts.layout')
@section('pageContent')
    <section id="services" class="section-padding bg-grey" data-scroll-index="2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title mb-30">
                        <h3>Create booking</h3>
                        <hr class="line line-hr-secondary">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <x-auth-errors />
                    @include('includes.sessionMsg')
                    <form method="post" action="{{ route('create_booking') }}">
                        @include('bookings.booking_form')
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
<script>
    function numberWithCommas(number) {
        var parts = number.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
    }

    // var datesForDisable = ["03-30-2022", "03-31-2022", "03-25-2022", "01-01-2022"]

    // $('.datepicker').datepicker({
    //     format: 'mm-dd-yyyy',
    //     autoclose: true,
    //     todayHighlight: true,
    //     datesDisabled: datesForDisable
    // });

    $(document).ready(function() {
        $('#locationInfo').hide()
        $('#categoryInfo').hide()

        $('#category').change(function() {
            let catId = $(this).val()
            $.ajax({
                type: "GET",
                url: `/booking-categories/${catId}`,
                dataType: "json",
                success: function(response) {
                    $('#categoryInfo').show()
                    $('#description').val(response.data.description)
                    let commaSeparatedPrice = numberWithCommas(response.data.price)
                    let price = $('#price').val(`#${commaSeparatedPrice}`)
                }
            });
        })

        $('#location').change(function() {
            let location = $(this).val()
            if (location == 'personal location') {
                $('#locationInfo').show()
            } else if (location == 'office location') {
                $('#locationInfo').hide()
            }


        })
    })
</script>
