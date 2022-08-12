@extends('layouts.layout')
@section('pageContent')

<section id="services" class="section-padding bg-grey" data-scroll-index="2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title mb-30"> 
                {{-- <span>Payment</span> --}}
                    <h3>Make Payment</h3>
                    <hr class="line line-hr-secondary">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h3 class="ml-1">By card</h3>
                <form method="POST" action="{{route('pay')}}">
                    @csrf
                    <div class="form-group">
                        <input type="text" style="background:inherit;" class="form-control" name="email" id="email" value="{{ucfirst($bookingDetails->user->email)}}" readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" style="background:inherit;" class="form-control" name="displayAmount" id="displayAmount" value="#{{number_format($bookingDetails->category->price, 2)}}" readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" style="background:inherit;" class="form-control" name="paymentFor" id="paymentFor" value="{{$bookingDetails->category->category}}" readonly>
                    </div>
                    <input type="hidden" value="{{ Paystack::genTranxRef() }}" name="reference">
                    <input type="hidden" value="{{$bookingDetails->category->price * 100}}" name="amount">
                    <input type="hidden" name="metadata" value="{{ json_encode($array = ['booking_id' => $bookingDetails->id, 'item_name' => $bookingDetails->category->category])}}">

                    @if($bookingDetails->payment_status === 1)
                        <em><strong> <u> Payment has been made </u> <span class="ti-check"></span> </strong></em>
                    @else
                        <button class="btn fl-btn btn-sm" type="submit">Proceed</button>
                    @endif
                </form>
            </div>

            <div class="col-md-6">
                <h3 class="">Bank transfer</h3>
                <div>
                    <input type="text" style="background:inherit;" class="form-control" id="" value="{{ucfirst($details->bank)}}" readonly>
                    <input type="text" style="background:inherit;" class="form-control" id="" value="{{ucfirst($details->acc_name)}}" readonly>
                    <input type="text" style="background:inherit;" class="form-control" id="acc_num" value="{{ucfirst($details->acc_number)}}" readonly> 
                    <input type="text" style="background:inherit;" class="form-control" id="" value="#{{number_format($bookingDetails->category->price, 2)}}" readonly>                   
                    <button class="btn fl-btn btn-sm" id="copy_acc_num" type="submit">Copy details</button>
                    
                </div>
                
            </div>
        </div>

    </div>
</section>

<script>
    function copyAccNum(){
        const accNum = document.querySelector('#acc_num')
        const copyBtn = document.querySelector('#copy_acc_num')

        copyBtn.addEventListener('click', () => {
            accNum.select();
            document.execCommand('copy');
            copyBtn.textContent = 'Account number copied'

            setTimeout(() => {
                copyBtn.textContent = 'Copy details'
            }, 1500)
        });
    }

    copyAccNum()
</script>
@endsection
