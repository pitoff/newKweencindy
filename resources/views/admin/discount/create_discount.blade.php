@extends('layouts.layout')
@section('pageContent')

<section id="services" class="section-padding bg-grey" data-scroll-index="2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title mb-30"> 
                    <h3>Create Discount</h3>
                    <hr class="line line-hr-secondary">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <form method="post" action="{{route('applyDiscount')}}">
                    @include('admin.discount.discount_form')
                </form>
            </div>
        </div>

    </div>
</section>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $("#percentage").keyup(function (e) {
            // e.preventDefault();
            let percentage = $(this).val()
            let amount = $("#amount").val()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type: "GET",
                url: "/admin/calculate-discount",
                data: {
                    "percent": percentage,
                    "amount": amount
                },
                dataType: "json",
                success: function (response) {
                    console.log("discount", response.data)
                    $("#discountedPrice").val(response.data)
                }
            });
        });
        jqp
    });
</script>