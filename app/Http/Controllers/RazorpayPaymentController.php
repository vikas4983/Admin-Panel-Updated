<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\RazorPay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RazorpayPaymentController extends Controller
{
    public function index(Request $request)
    {
        $plan = Plan::find($request->plan_id);
        $order = rand(1111, 99999);
        return view('razorpay/razorpayView', compact('plan',  'order'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {

        $plan = Plan::find($request->plan_id);
        $plan_id = $request->plan_id;
        $admin_id = $request->admin_id;
        $price = $plan->price;
        $offer_price = $plan->offer_price;
        //$plan = $plan->allow_contact;

        $input = $request->all();
        ($api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET')));
        ($payment = $api->payment->fetch($input['razorpay_payment_id']));
        if ($payment['status'] == 'authorized') {
            if (count($input)  && !empty($input['razorpay_payment_id'])) {
                try {
                    $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));

                    if ($payment['status'] == 'authorized' && $response['status'] == 'captured') {
                        $paymentData = array_merge(
                            [
                                'entity' => $response['entity'],
                                'amount' => $response['amount'],
                                'currency' => $response['currency'],
                                'status' => $response['status'],
                                'invoice_id' => $response['invoice_id'],
                                'international' => $response['international'],
                                'method' => $response['method'],
                                'amount_refunded' => $response['amount_refunded'],
                                'refund_status' => $response['refund_status'],
                                'captured' => $response['captured'],
                                'description' => $response['description'],
                                'card_id' => $response['card_id'],
                                'bank' => $response['bank'],
                                'wallet' => $response['wallet'],
                                'vpa' => $response['vpa'],
                                'fee' => $response['fee'],
                                'tax' => $response['tax'],
                                'error_code' => $response['error_code'],
                                'error_description' => $response['error_description'],
                                'error_source' => $response['error_source'],
                                'error_step' => $response['error_step'],
                                'error_reason' => $response['error_reason'],
                            ],
                            $input
                        );
                        // Plan Expiry Date
                        $currentDate = Carbon::now();
                        $expiryDate = $currentDate->addDays($plan->duration);
                        $formattedDate = $expiryDate->format('d-m-Y H:i:s');

                        // Get the latest payment
                        $previouse_plan = Payment::latest('created_at')->first();

                        if ($previouse_plan) {
                            // Previouse Plan 
                            $previouse_plan = $previouse_plan->contact;
                            $plan = $plan->allow_contact;
                            $contact = (float)$previouse_plan + (float)$plan;
                            DB::beginTransaction();
                            RazorPay::create($paymentData);
                            Payment::create([
                                'user_id' => $admin_id,
                                'plan_id' => $plan_id,
                                'price' => floor($price),
                                'paid' => floor($offer_price),
                                'contact' => $contact,
                                'expiry_date' => $formattedDate,

                            ]);
                            DB::commit();
                            $msg = "congratulation Your Payment Was Successful Now Your Account is Active!";
                            return redirect('admin/dashboard')->with('success', $msg);
                        } else {
                            DB::beginTransaction();
                            RazorPay::create($paymentData);
                            Payment::create([
                                'user_id' => $request->admin_id,
                                'plan_id' => $plan->id,
                                'price' => floor($plan->price),
                                'paid' => floor($plan->offer_price),
                                'contact' => $plan->allow_contact,
                                'expiry_date' => $formattedDate,

                            ]);
                            DB::commit();
                        }
                        $msg = "congratulation Your Payment Was Successful Now Your Account is Active!";
                        return redirect('admin/dashboard')->with('success', $msg);
                    } else {
                        return "error";
                    }
                } catch (Exception $e) {
                    DB::rollBack();
                    $msg = "Something Went Wrong, Please Try Again!";
                    return redirect('admin/dashboard')->with('error', $msg);
                }
            }
        }
    }
}
