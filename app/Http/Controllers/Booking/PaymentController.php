<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
    public function redirectToGateway(Request $request)
    {

        // dd($request->all());
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        } 
    }

    public function handleGatewayCallback(Request $request)
    {
        $paymentDetails = Paystack::getPaymentData();

        // dd($paymentDetails);
        //on successfull payment
        //store in payment table, update bookings.payment_status to 1
        //notify payment success to user and admin
        //return redirect to my bookings
        $bookingId = $paymentDetails['data']['metadata']['booking_id'];
        try {
            $createPayment = $request->user()->payment()->create([
                "booking_id" => $bookingId,
                "email" => $paymentDetails['data']['customer']['email'],
                "item_paid" => $paymentDetails['data']['metadata']['item_name'],
                "amount" => $paymentDetails['data']['amount'],
                "status" => $paymentDetails['data']['status'],
                "order_id" => $paymentDetails['data']['id'],
                "tranx_ref" => $paymentDetails['data']['reference']
            ]);
    
            if($paymentDetails['data']['status'] !== 'success'){
                return redirect(route('my_booking', $bookingId))->with('err', 'Transaction was not successfull');
            }

            $bookedPaymentStatus = Booking::where('id', $bookingId)->update([
                'payment_status' => 1
            ]);
            
            return redirect(route('my_booking', $bookingId))->with('success', 'Transaction was successfull');

        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('my_booking', $bookingId))->with('err', 'Transaction could not be processed');
        }
        
    }

    public function showPaymentDetails($id)
    {
        $bookingDetails = Booking::where('id', $id)->first();
        $details = PaymentMethod::where('is_active', 1)->first();
        return view('payment.payment_details', compact('details', 'bookingDetails'));
    }
}
