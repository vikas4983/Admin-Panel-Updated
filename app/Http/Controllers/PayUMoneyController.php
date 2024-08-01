<?php

namespace App\Http\Controllers;

use App\Models\Failed;
use App\Models\Payment;
use App\Models\PayUMoney;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PayUMoneyController extends Controller
{
    public function payUMoneyView(Request $request)
    {
        //dd ($request->all());
        $plan_id = $request->plan_id;
        $admin_id = $request->admin_id;
        $name = $request->name;
        $allow_contact = $request->allow_contact;
        $offer_price = $request->offer_price;

        $MERCHANT_KEY = "fB7m8s"; // TEST MERCHANT KEY
        $SALT = "eRis5Chv"; // TEST SALT
        $PAYU_BASE_URL = "https://test.payu.in";

        //$PAYU_BASE_URL = "https://secure.payu.in"; // PRODUCATION
        $name = $name;
        $successURL = route(
            'pay.u.response',
            [
                'plan_id' => $plan_id,
                'admin_id' => $admin_id,
                'offer_price' => $offer_price,
                'allow_contact' => $allow_contact,
            ]
        );
        $failURL = route('pay.u.cancel', [
            'plan_id' => $plan_id,
            'admin_id' => $admin_id,
            'offer_price' => $offer_price,

        ]);
        $email = 'example@gmail.com';
        $amount = $offer_price;

        $action = '';
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $posted = array();
        $posted = array(
            'key' => $MERCHANT_KEY,
            'txnid' => $txnid,
            'amount' => $amount,
            'firstname' => $name,
            'email' => $email,
            'productinfo' => 'Webappfix',
            'surl' => $successURL,
            'furl' => $failURL,
            'service_provider' => null,
        );

        if (empty($posted['txnid'])) {
            $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        } else {
            $txnid = $posted['txnid'];
        }

        $hash = '';
        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";

        if (empty($posted['hash']) && sizeof($posted) > 0) {
            $hashVarsSeq = explode('|', $hashSequence);
            $hash_string = '';
            foreach ($hashVarsSeq as $hash_var) {
                $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
                $hash_string .= '|';
            }
            $hash_string .= $SALT;

            $hash = strtolower(hash('sha512', $hash_string));
            $action = $PAYU_BASE_URL . '/_payment';
        } elseif (!empty($posted['hash'])) {
            $hash = $posted['hash'];
            $action = $PAYU_BASE_URL . '/_payment';
        }

        return view('payumoney/pay-u', compact('action', 'hash', 'MERCHANT_KEY', 'txnid', 'successURL', 'failURL', 'name', 'email', 'amount'));
    }

    public function payUResponse(Request $request)
    {
        try {
            // Extracting data from the request
            $admin_id = $request->query('admin_id');
            $amount = $request->query('offer_price');
            $plan_id = $request->query('plan_id');
            $allow_contact = $request->query('allow_contact');
            // Response variables
            $status = $request->status;
            $mihpayid = $request->mihpayid;
            $mode = $request->mode;
            $txnid = $request->txnid;
            $paid = $request->net_amount_debit;
            $productinfo = $request->productinfo;
            $hash = $request->hash;
            $payuMoneyId = $request->payuMoneyId;
            $paymentText = $request->field9;
            $giftCardIssued = $request->giftCardIssued;
            $bank_ref_num = $request->bank_ref_num;
            $bankcode = $request->bankcode;
            $error = $request->error;
            $error_Message = $request->error_Message;
            $columnName = "mihpayid";

            // Column Value if Exist Then Excute The Line
            $column_mihpayid = PayUMoney::where($columnName, $mihpayid)->value($columnName);

            if ($column_mihpayid == $mihpayid) {
                return redirect('admin/plans/plan');
            }

            if ($column_mihpayid != $mihpayid) {
                if ($status == 'success') {

                    // For expiry date
                    $plan = Plan::findOrFail($plan_id);
                    $currentDate = Carbon::now();
                    $expiryDate = $currentDate->addDays($plan->duration);
                    $formattedDate = $expiryDate->format('d-m-Y H:i:s');

                    // Get the latest payment
                    $previouse_plan = Payment::latest('created_at')->first();
                    if ($previouse_plan) {
                        $contact = $previouse_plan->contact;
                        // New payment Create
                        DB::beginTransaction();

                        Payment::create([
                            'admin_id' => $admin_id,
                            'plan_id' => $plan_id,
                            'paid' => floor($paid),
                            'amount' => floor($amount),
                            'contact' => $contact + $allow_contact,
                            'expiry_date' => $formattedDate,
                        ]);

                        PayUMoney::create([
                            'admin_id' => $admin_id,
                            'plan_id' => $plan_id,
                            'mihpayid' => $mihpayid,
                            'paid' => floor($paid),
                            'amount' => floor($amount),
                            'mode' => $mode,
                            'txnid' => $txnid,
                            'productinfo' => $productinfo,
                            'hash' => $hash,
                            'payuMoneyId' => $payuMoneyId,
                            'status' => $status,
                            'paymentText' => $paymentText,
                            'giftCardIssued' => $giftCardIssued,
                            'bank_ref_num' => $bank_ref_num,
                            'bankcode' => $bankcode,
                            'error' => $error,
                            'error_Message' => $error_Message,
                        ]);

                        // PayUMoney::create($request->all());

                        DB::commit();

                        $msg = "You have successfully upgraded a plan!";
                        //$url = route('plann');
                        return redirect()->route("plann")->with('success', $msg);
                        //return redirect('error')->with('success', $msg);
                        return "Second";
                    } else {
                        // For expiry date
                        $plan = Plan::findOrFail($plan_id);
                        $currentDate = Carbon::now();
                        $expiryDate = $currentDate->addDays($plan->duration);
                        $formattedDate = $expiryDate->format('d-m-Y H:i:s');

                        // Taken plan First Time
                        DB::beginTransaction();

                        Payment::create([
                            'admin_id' => $admin_id,
                            'plan_id' => $plan_id,
                            'paid' => floor($paid),
                            'amount' => floor($amount),
                            'contact' => $allow_contact,
                            'expiry_date' => $formattedDate,
                        ]);

                        PayUMoney::create([
                            'admin_id' => $admin_id,
                            'plan_id' => $plan_id,
                            'mihpayid' => $mihpayid,
                            'paid' => floor($paid),
                            'amount' => floor($amount),
                            'mode' => $mode,
                            'txnid' => $txnid,
                            'productinfo' => $productinfo,
                            'hash' => $hash,
                            'payuMoneyId' => $payuMoneyId,
                            'status' => $status,
                            'paymentText' => $paymentText,
                            'giftCardIssued' => $giftCardIssued,
                            'bank_ref_num' => $bank_ref_num,
                            'bankcode' => $bankcode,
                            'error' => $error,
                            'error_Message' => $error_Message,
                        ]);

                        DB::commit();

                        $msg = "You have successfully bought a plan!";
                        // $url = route('admin.plans.plan');
                        return redirect()->route("plann")->with('success', $msg);
                        return "first";
                    }
                }
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            // dd($ex->getMessage());
            $msg = "An error occurred while processing your request.";
            // $url = route('admin.plans.plan');
            abort(404);
        }
    }


    public function payUCancel(Request $request)
    {
        // Extracting data from the request
        $admin_id = $request->query('admin_id');
        $amount = $request->query('offer_price');
        $plan_id = $request->query('plan_id');
        // Response variables
        $status = $request->status;
        $mihpayid = $request->mihpayid;
        $mode = $request->mode;
        $txnid = $request->txnid;
        $paid = $request->net_amount_debit;
        $productinfo = $request->productinfo;
        $hash = $request->hash;
        $payuMoneyId = $request->payuMoneyId;
        $paymentText = $request->field9;
        $giftCardIssued = $request->giftCardIssued;
        $bank_ref_num = $request->bank_ref_num;
        $bankcode = $request->bankcode;
        $error = $request->error;
        $error_Message = $request->error_Message;
        // Column name
        $columnName = 'mihpayid';
        // Column Value if Exist Then Excute The Line
        $previouseColumnValue = Failed::where($columnName, $mihpayid)->value($columnName);
        dd($previouseColumnValue);
        if ($status == 'failure' && $previouseColumnValue == $mihpayid) {
            return redirect()->back();
        } else {
            Failed::create([
                'admin_id' => $admin_id,
                'plan_id' => $plan_id,
                'mihpayid' => $mihpayid,
                'paid' => floor($paid),
                'amount' => floor($amount),
                'mode' => $mode,
                'txnid' => $txnid,
                'productinfo' => $productinfo,
                'hash' => $hash,
                'payuMoneyId' => $payuMoneyId,
                'status' => $status,
                'paymentText' => $paymentText,
                'giftCardIssued' => $giftCardIssued,
                'bank_ref_num' => $bank_ref_num,
                'bankcode' => $bankcode,
                'error' => $error,
                'error_Message' => $error_Message,
            ]);
            $msg = "Your Payment Was Unsuccessfull, Please Try Again!";
            return redirect()->route("plann")->with('info', $msg);
        }
    }
}
