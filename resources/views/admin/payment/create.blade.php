@extends('layouts.layout')
@section('pageContent')

<section id="services" class="section-padding bg-grey" data-scroll-index="2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- <div class="title mb-30"> <span>categories</span>
                    <h2>Payment method</h2>
                    <hr class="line line-hr-secondary">
                </div> -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-2">
                <h3 class="ml-1">Create Payment Method</h3>

                <form method="post" action="{{route('payment.store')}}">
                    @csrf
                    <div class="col-sm-8">
                        <div class="form-group">
                            <input type="text" class="form-control" name="bank" value="@isset($payment) {{ $payment->bank }} @endisset" placeholder="Bank Name *">
                            @error('bank')
                            <em class="text-danger">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="form-group">
                            <input type="text" class="form-control" name="accNo" value="@isset($payment) {{ $payment->acc_number }} @endisset" placeholder="Account Number *">
                            @error('accNo')
                            <em class="text-danger">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="form-group">
                            <input type="text" class="form-control" name="accName" value="@isset($payment) {{ $payment->acc_name }} @endisset" placeholder="Account Name *">
                            @error('accName')
                            <em class="text-danger">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="form-group">
                            <button class="btn fl-btn btn-sm" type="submit">Save</button>

                            <a href="{{route('payment.index')}}" class="btn fl-btn float-right" type="submit">Back to Payment methods</a>
                        </div>

                        <div class="form-group pull-right">
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
</section>

@endsection