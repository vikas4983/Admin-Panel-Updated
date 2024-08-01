<?php

namespace App\Http\Controllers;

use App\Models\SpoteLight;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\ProfileTrait;

class SpoteLightController extends Controller
{
    use ProfileTrait;
   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spotelights = SpoteLight::with(['user'=> function ($query){
         $query->where('status', 1);
        }])
        ->where('is_spote_light', 1)
        
        ->get();
        // dd($paidUsers);
        $profilePrefixs = $this->profilePrefix();
       

        return view('admin.spotelights.index', compact('spotelights', 'profilePrefixs'));
    }





// $paidUsers = SpoteLight::where('is_spote_light', 1)
//         ->whereHas('user', function ($query) {
//             $query->where('status', 1);
//         })
//         ->whereIn('id', function ($query) {
//             $query->select(DB::raw('MAX(id)'))
//             ->from('spote_lights')
//             ->where('is_spote_light', 1)
//             ->groupBy('user_id');
//         })
//         ->with('user')
//         ->get();

//         $profilePrefixs = $this->profilePrefix();

//         return view('admin.spotelights.index', compact('paidUsers', 'profilePrefixs'));











    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $userId = $request->user_id;
        $spoteLightDate = $request->duration;

        if ($userId) {
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id',
                'duration' => 'required|date|max:255',
            ]);
            $validatedData['is_spote_light'] = 1;
            SpoteLight::create($validatedData);

            return redirect()->back()->with('success', "Spote Light Created Successfully");
        } else {
            return redirect()->back()->with('error', "User ID is required.");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SpoteLight $spoteLight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SpoteLight $spoteLight)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SpoteLight $spoteLight)
    {
        $userId = $request->user_id;
        $spoteLightDuration = $request->duration;

        $previousSpoteLight = SpoteLight::latest('created_at')
        ->where('user_id', $userId)
        ->first(); 
        //dd($previousSpoteLight);
        
        // Retrieve the latest SpoteLight for the user

        if ($previousSpoteLight) {
             $previousSpoteLight->update([
              'is_spote_light' => 0
             ]);
            // Convert 'duration' attribute to Carbon instance if needed
            $previousDuration = Carbon::parse($previousSpoteLight->duration);

            // Calculate new duration by adding days
            $newDuration = $previousDuration->copy()->addDays($spoteLightDuration);

            // Update the SpoteLight with the new duration
            SpoteLight::create([
                'user_id' => $userId,
                'duration' => $newDuration->toDateTimeString(), // Store the updated duration
                'is_spote_light' => 1,
            ]);

            return redirect()->back()->with('success', "Spote Light Updated Successfully!");
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpoteLight $spoteLight)
    {
        //
    }
}
