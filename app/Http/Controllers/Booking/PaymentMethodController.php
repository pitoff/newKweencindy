<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment = PaymentMethod::all();
        return view('payment.index', compact('payment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'bank' => 'required',
            'accNo' => 'required',
            'accName' => 'required'
        ]);

        $create = PaymentMethod::create([
            'bank' => $request->bank,
            'acc_number' => $request->accNo,
            'acc_name' => $request->accName
        ]);

        if($create){
            return redirect(route('payment.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = PaymentMethod::find($id);
        return view('payment.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $paymentMethod = PaymentMethod::find($id);
        $request->validate([
            'bank' => 'required',
            'accNo' => 'required',
            'accName' => 'required'
        ]);

        $update = $paymentMethod->update([
            'bank' => $request->bank,
            'acc_number' => $request->accNo,
            'acc_name' => $request->accName
        ]);

        if($update){
            return redirect(route('payment.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::find($id);
        $paymentMethod->delete();
        return back(); 
    }

    public function activate(PaymentMethod $pay, $id)
    {
        $getMethod = PaymentMethod::find($id);
        $paymentMethods = $pay->where('is_active', 1)->first();
        if($paymentMethods){
            return back()->with('error', 'Please deactivate already active payment method');
            
        }else{
            $updateMethod = $getMethod->update([
                'is_active' => true
            ]);
    
            if($updateMethod){
                return back()->with('success', 'You successfully activated payment method');
            }
        }
        
    }

    public function deactivate($id)
    {
        $getMethod = PaymentMethod::find($id);
        $getMethod->update([
            'is_active' => false
        ]);
        return back()->with('success', 'You successfully activated payment method');
    }

    public function showPaymentDetails()
    {
        $details = PaymentMethod::where('is_active', 1)->get();
        return view('payment.payment_details', compact('details'));
    }
}
