<?php

namespace App\Http\Controllers;

use App\Models\PaymentGateway;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePaymentGatewayRequest;
use App\Http\Requests\UpdatePaymentGatewayRequest;
use Illuminate\Http\Request;

class PaymentGatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentGateways= PaymentGateway::all();
        return view('admin.paymentgateways.index', compact('paymentGateways'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.paymentgateways.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePaymentGatewayRequest $request)
    {
        PaymentGateway::create($request->all());
        return view('admin.paymentgateways.edit')->with('success', " Razorpay Payment Registered Successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentGateway $paymentGateway)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)

    {
        $PaymentGateway = PaymentGateway::find($id);
         
       
        return view('admin.paymentgateways.edit', compact('paymentGateway'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentGatewayRequest $request, $id)
    {
        if ($id) {
              $paymentGateways = PaymentGateway::find($id);
            $paymentGateways->update($request->all());
            return view('admin.paymentgateways.index',compact('paymentGateways'))->with('success', " Payment Gateway Registered Successfully!");
        } else {
            return view('admin.paymentgateways.index')->with('error', " Something Went Wrong!");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentGateway $paymentGateway)
    {
        //
    }
}
