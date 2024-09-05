<?php

namespace App\Http\Controllers\admin\countries;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\countries\CreateCityRequest;
use App\Http\Requests\admin\countries\UpdateCityRequest;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use App\Traits\ModelCountsTrait;

class CityController extends Controller
{
    use ModelCountsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities =
        City::orderByDesc('created_at')->paginate(10);
        $count = ($cities->currentPage() - 1) * $cities->perPage();
        // Activbe Count
        $active = City::where('status', 1)->count();
        //Inactive Count
        $inActive = City::where('status', 0)->count();
        // All Count
        $countAll = City::count();
        $url = request()->path();
        $segments = explode('/', $url);
        $lastSegment = end($segments);
        $urlName = '/' . $lastSegment;
        $this->indexCount(City::class, $urlName);
        
        return view('admin.countries.states.cities.index', compact('cities','count', 'active', 'inActive', 'countAll'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states =  State::all();
        return view('admin.countries.states.cities.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCityRequest $request)
    {

        City::create([
            'state_id' => $request->state_id,
            'city' => $request->city,
            'status' => $request->status

        ]);
        $msg = "City Added Successfully";
        return redirect('admin/cities')->with('success', $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        $states = State::all();
        return view('admin.countries.states.cities.edit', compact('city', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        $city =  City::with('State')->find($city->id);
        $city->update([
            'state_id' => $request->state_id,
            'city' => $request->city,
            'status' => $request->status
        ]);
        $msg = "City Updated Successfully";
        return redirect('admin/cities')->with('info', $msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->destroy($city->id);
        $msg = "City Deleted Successfully";
        return redirect('admin/cities')->with('error', $msg);
    }

    public function checkBoxDelete(Request $request)
    {
        //dd('checkBoxDelete');
        //dd($request->all());
        $selectedDeleteCityIds = $request->input('selectedDeleteCityIds');
        if (!empty($selectedDeleteCityIds)) {
            $ids = explode(',', $selectedDeleteCityIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $cities = City::find($id);
                if ($cities) {
                    $cities->delete(); // Use delete() method to delete a single record
                }
            }

            return redirect()->back()->with('error', 'Selected City Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }

    public function activeItem(Request $request)
    {

        //dd('activeItem');
         //dd($request->all());
        $selectedActiveCityIds = $request->input('selectedActiveCityIds');
        if (!empty($selectedActiveCityIds)) {
            $ids = explode(',', $selectedActiveCityIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $cities = City::find($id);
                if ($cities) {
                    $cities->update([
                        'status' => 1
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected City Activated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
    public function inActiveItem(Request $request)
    {
        //dd('inActiveItem');
        //dd($request->all());
        $selectedInactiveCityIds = $request->input('selectedInactiveCityIds');
        if (!empty($selectedInactiveCityIds)) {
            $ids = explode(',', $selectedInactiveCityIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $cities = City::find($id);
                if ($cities) {
                    $cities->update([
                        'status' => 0
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected City inActivated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
}
