<?php

namespace App\Http\Controllers;

use App\Models\SpoteLight;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\ProfileTrait;
use App\Traits\ModelCountsTrait;

class SpoteLightController extends Controller
{
    use ProfileTrait;
    use ModelCountsTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $spotelights = $this->spoteLightStatus();
        $fullUrl = $request->fullUrl();
        $segments = explode('/', $fullUrl);
        $lastSegment = end($segments);
        $urlName = '/' . $lastSegment;
        $profilePrefixs = $this->profilePrefix();
        $count = $spotelights->count();
        $this->spoteLightCount(SpoteLight::class, $urlName, $count);
        return view('admin.spotelights.index', compact('spotelights', 'profilePrefixs'));
    }

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
        if ($previousSpoteLight) {
            $previousSpoteLight->update([
                'is_spote_light' => 0
            ]);
            $previousDuration = Carbon::parse($previousSpoteLight->duration);
            $newDuration = $previousDuration->copy()->addDays($spoteLightDuration);
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

    public function spoteLightStatus()
    {
        $spoteLightStatus = SpoteLight::with('user')->get();
        $currentDate = now();
        foreach ($spoteLightStatus as $spoteLightStatu) {
            if ($spoteLightStatu->duration >= $currentDate) {
                $spoteLightStatu->update([
                    'is_spote_light' => 1
                ]);
            } else {
                $spoteLightStatu->update([
                    'is_spote_light' => 0
                ]);
            }
        }
        $spotlights = SpoteLight::where('is_spote_light', 1)
            ->latest('created_at')
            ->get()
            ->unique('id');
        return $spotlights;
    }
}
