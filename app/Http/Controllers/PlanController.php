<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Plan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::orderByDesc('created_at')->paginate(10);
        $count = ($plans->currentPage() - 1) * $plans->perPage();
        // Activbe Count
        $active = Plan::where('status', 1)->count();
        //Inactive Count
        $inActive = Plan::where('status', 0)->count();
        // All Count
        $countAll = Plan::count();



        return view('admin.plans.index', compact('plans', 'count', 'active', 'inActive', 'countAll'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request->all();
        $price = $request->price;
        $offer = $request->offer;
        $percentage = (float)$price * (float)$offer / 100;
        $offer_price = (float)$price - (float)$percentage;
        $per_month = (float)$offer_price / 30;
        $saving = (float)$price - (float)$offer_price;


        Plan::create([
            'name' => $request->name,
            'duration' => $request->duration,
            'price' => $request->price,
            'offer' => $request->offer,
            'offer_price' => floor($offer_price),
            'per_month' => floor($per_month),
            'saving' => floor($saving),
            'allow_contact' => $request->allow_contact,
            'chat' => $request->chat,
            'video_call' => $request->video_call,
            'message' => $request->message,
            'status' => $request->status

        ]);

        $msg = "Plan  Added Successfully!";
        return redirect('admin/plans')->with('success', $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        //return $request->all();
        $price = $request->price;
        $offer = $request->offer;
        $percentage = (float)$price * (float)$offer / 100;
        $offer_price = (float)$price - (float)$percentage;
        $per_month = (float)$offer_price / 30;
        $saving = (float)$price - (float)$offer_price;

        $plan->update([
            'name' => $request->name,
            'duration' => $request->duration,
            'price' => $request->price,
            'offer' => floor($request->offer),
            'offer_price' => floor($offer_price),
            'per_month' => floor($per_month),
            'saving' => floor($saving),
            'allow_contact' => $request->allow_contact,
            'chat' => $request->chat,
            'video_call' => $request->video_call,
            'message' => $request->message,
            'status' => $request->status
        ]);
        $msg = "Plan Updated Successfully!";

        return redirect('admin/plans')->with('info', $msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        $plan->destroy($plan->id);
        $msg = "Plan Deleted Successfully";

        return redirect('admin/plans')->with('error', $msg);
    }

    public function plan()
    {
        $plans = Plan::all();
        // Get the ID of the currently authenticated admin
        $adminId = Auth::id();
        // $currentDate = Carbon::now();
        // Retrieve the latest payment made by the admin
        $latestPayment = Payment::orderBy('created_at', 'desc')
            ->where('user_id', $adminId)
            ->with(['user'])
            ->first();
        if ($latestPayment ?? '') {
            $expiryDate = Carbon::parse($latestPayment->expiry_date);
            $currentDate = Carbon::now();
            return view('admin.plans.plan', compact('plans', 'adminId', 'latestPayment', 'expiryDate', 'currentDate'));
        } else {
            return view('admin.plans.plan', compact('plans',));
        }
    }
    
    public function checkBoxDelete(Request $request)
    {
        //dd('checkBoxDelete');
        //dd($request->all());
        $selectedDeletePlanIds = $request->input('selectedDeletePlanIds');
        if (!empty($selectedDeletePlanIds)) {
            $ids = explode(',', $selectedDeletePlanIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $plans = Plan::find($id);
                if ($plans) {
                    $plans->delete(); // Use delete() method to delete a single record
                }
            }

            return redirect()->back()->with('error', 'Selected Plan Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }

    public function activeItem(Request $request)
    {

        //dd('activeItem');
        //dd($request->all());
        $selectedActivePlanIds = $request->input('selectedActivePlanIds');
        if (!empty($selectedActivePlanIds)) {
            $ids = explode(',', $selectedActivePlanIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $plans = Plan::find($id);
                if ($plans) {
                    $plans->update([
                        'status' => 1
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected Plan Activated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
    public function inActiveItem(Request $request)
    {
        //dd('inActiveItem');
        // dd($request->all());
        $selectedInactivePlanIds = $request->input('selectedInactivePlanIds');
        if (!empty($selectedInactivePlanIds)) {
            $ids = explode(',', $selectedInactivePlanIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $plans = Plan::find($id);
                if ($plans) {
                    $plans->update([
                        'status' => 0
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected Plan inActivated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
}
