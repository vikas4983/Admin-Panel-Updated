<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Payment $payment)
    {
        $userId = $request->user_id;
        $planId = $request->plan_id;

        // Find the plan by ID
        $plan = Plan::find($planId);

        // Check if the plan exists
        if ($plan) {
            $currentDate = Carbon::now();

            // Create a new payment record
            Payment::create([
                'user_id' => $userId,
                'plan_id' => $planId,
                'contact' => $plan->allow_contact,
                'expiry_date' => $currentDate->addDays($plan->duration),
                'is_paid' => '1',
            ]);

            return redirect()->back()->with('success', "Plan is Activated");
        }

        return redirect()->back()->with('error', "Plan not found");
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
     
        $selectPlanId = $request->plan_id; // Ensure the correct name is used
        $userId = $request->user_id;

        // Fetch the selected plan
        $plan = Plan::find($selectPlanId);

        if (!$plan) {
            return redirect()->back()->with('error', 'Plan not found');
        }

        // Fetch the latest payment for the user
        $latestPayment = Payment::where('user_id', $userId)
        ->latest('created_at')
        ->first();

        $currentDate = Carbon::now();
        $contactLimit = (float) $plan->allow_contact;

        if ($latestPayment) {
            // Get the previous payment details
            $previousContact = (float) $latestPayment->contact;
            $expiryDate = Carbon::parse($latestPayment->expiry_date);

            if ($expiryDate >= $currentDate) {
                // Renew the existing plan
                $latestPayment->update([
                    'is_paid' => 0
                ]);
                $newExpiryDate = $expiryDate->addDays($plan->duration);
                $totalContact = $contactLimit + $previousContact;

            } else {
                // Create a new payment if the previous plan has expired
                $newExpiryDate = $currentDate->addDays($plan->duration);
                $totalContact = $contactLimit;
            }
        } else {
            // No previous payments, create a new payment
            $newExpiryDate = $currentDate->addDays($plan->duration);
            $totalContact = $contactLimit;
        }

        // Create or update payment record
        Payment::create([
            'user_id' => $userId,
            'plan_id' => $plan->id,
            'contact' => $totalContact,
            'expiry_date' => $newExpiryDate,
            'is_paid' => '1',
        ]);

        return redirect()->back()->with('success', "Plan Activated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }

    // public function payment(Request $request, $token)
    // {
    //     if (Auth::guard('admin')->check()) {
    //         $admin_id = Auth::guard('admin')->id();

    //         if ($token == 1) {
    //             $admin_id = $admin_id;
    //             $plan_id = $request->plan_id;
    //             $name = $request->name;
    //             $duration = $request->duration;
    //             $offer_price = $request->offer_price;
    //             $allow_contact = $request->allow_contact;
    //             $message = $request->message;
    //             $chat = $request->chat;
    //             $video_call = $request->video_call;

    //             // For expiry date
    //             $plan = Plan::findOrFail($plan_id);
    //             $currentDate = Carbon::now();
    //             $expiryDate = $currentDate->addDays($plan->duration);
    //             $formattedDate = $expiryDate->format('d-m-Y H:i:s');

    //             // Previouse Payment
    //             $previouse_plan = Payment::latest('created_at', 'desc')->first();
    //             if($previouse_plan){
    //                 $contact = $previouse_plan->allow_contact;
    //                 // New payment Create
    //                 Payment::create([
    //                     'admin_id' => $admin_id,
    //                     'plan_id' => $plan_id,
    //                     'amount' => floor($offer_price),
    //                     'plan_name' => $name,
    //                     'duration' => $duration,
    //                     'allow_contact' => $contact + $allow_contact,
    //                     'message' => $message,
    //                     'chat' => $chat,
    //                     'video_call' => $video_call,
    //                     'expiry_date' => $formattedDate,
    //                 ]);
    //                 $msg = "You have successfully upgrade a plan!";
    //                 return redirect()->back()->with('success', $msg);
    //             }else
    //             {
    //                 $admin_id = $admin_id;
    //                 $plan_id = $request->plan_id;
    //                 $name = $request->name;
    //                 $duration = $request->duration;
    //                 $offer_price = $request->offer_price;
    //                 $allow_contact = $request->allow_contact;
    //                 $message = $request->message;
    //                 $chat = $request->chat;
    //                 $video_call = $request->video_call;

    //                 // For expiry date
    //                 $plan = Plan::findOrFail($plan_id);
    //                 $currentDate = Carbon::now();
    //                 $expiryDate = $currentDate->addDays($plan->duration);
    //                 $formattedDate = $expiryDate->format('d-m-Y H:i:s');
    //                 Payment::create([
    //                     'admin_id' => $admin_id,
    //                     'plan_id' => $plan_id,
    //                     'amount' => floor($offer_price),
    //                     'plan_name' => $name,
    //                     'duration' => $duration,
    //                     'allow_contact' => $allow_contact,
    //                     'message' => $message,
    //                     'chat' => $chat,
    //                     'video_call' => $video_call,
    //                     'expiry_date' => $formattedDate,
    //                 ]);

    //                 $msg = "You have successfully Buy a plan!";
    //                 return redirect()->back()->with('error', $msg);
    //             }

    //         } 
    //     } else {
    //         $msg = "Please Login First After That Make Payment!";
    //         return redirect('admin_login')->with('error', $msg);
    //     }
    // }

    //  public function activePlan(){
    //     $user = Auth::user()->id;
    //     dd($user);

    //  }


}
