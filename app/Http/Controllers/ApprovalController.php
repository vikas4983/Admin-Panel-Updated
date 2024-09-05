<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateApprovalsRequest;
use App\Http\Requests\UpdateApprovalsRequest;
use App\Models\Approval;
use App\Models\Payment;
use App\Models\User;
use App\Traits\ProfileTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ModelCountsTrait;



class ApprovalController extends Controller
{
    use ModelCountsTrait;

   use ProfileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd($request->all());
        $approvals = Approval::with([
            'user.payments',
            'user.successStories',])->orderByDesc('created_at')->paginate(10);
        $planStatus = $this->planStatus(); // Get the plan status
        $premiumStatus = $this->premium(); // Call the premium method
        $profilePrefixes = $this->profilePrefix();
        $url = request()->path();
        $segments = explode('/', $url);
        $lastSegment = end($segments);
        $urlName = '/' . $lastSegment;
        $this->indexCount(Approval::class, $urlName);
        return view('admin.approvals.index', compact('approvals', 'planStatus', 'premiumStatus', 'profilePrefixes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.approvals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateApprovalsRequest $request)
    {
        $validatedData = $request->validated();
        $userId = Auth::user()->id;
        if($validatedData && $userId ){
            $validatedData['user_id'] = $userId;
            Approval::create($validatedData);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Approval $approval)
    {
        $users = User::all();
        return view('admin.approvals.show', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Approval $approval)
    {
        return view('admin.approvals.edit', compact('approval'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApprovalsRequest $request, Approval $approval)
    {   
       // dd($request->all());
        $validatedData = $request->validated();
        if($approval){
            $approval->update($validatedData);
        }
        return redirect('admin/approvals');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Approval $approval)
    {
        //
    }

    public function planStatus()
    {
        $adminId = Auth::user()->id;
        $latestPayment = Payment::orderBy('created_at', 'desc')
            ->where('user_id', $adminId)
            ->with(['user'])
            ->first();
        if ($latestPayment ?? '') {
            $expiryDate = Carbon::parse($latestPayment->expiry_date);
            $currentDate = Carbon::now();
            if ($expiryDate > $currentDate) {
                return "Premium";
            } else {
                return "Free";
            }
        } else {
            return "Free"; // Default to "Free" if there are no payments
        }
    }
    public function premium()
    {
        $adminId = Auth::user()->id;
        $latestPayment = Payment::orderBy('created_at', 'desc')
            ->where('user_id', $adminId)->first();
        $latestPaymentId = $latestPayment->id;
        //dd($latestPaymentId);

        if ($latestPayment ?? '') {
            $expiryDate = Carbon::parse($latestPayment->expiry_date);
            $currentDate = Carbon::now();
            if ($expiryDate >  $currentDate) {
                $approvals = Approval::with(['user' => function ($query) {
                    $query->with('payments');
                }])->get();

                $premiumStatus = "Premium Vikas";
                return  [$approvals, $premiumStatus];
            } else {
                if ($latestPaymentId) {
                    $payment = Payment::find($latestPaymentId);
                    $payment->delete();
                    return "Home Free";
                } else {
                    return "error";
                }
            }
        }

        return "Free123";
    }
}
