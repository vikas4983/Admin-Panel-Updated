<?php

namespace App\Http\Controllers\admin\countries;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\countries\CreateStateRequest;
use App\Http\Requests\admin\countries\UpdateStateRequest;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use App\Traits\ModelCountsTrait;

class StateController extends Controller
{
    use ModelCountsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $states =
        State::orderByDesc('created_at')->paginate(10);
        $count = ($states->currentPage() - 1) * $states->perPage();
        // Activbe Count
        $active = State::where('status', 1)->count();
        //Inactive Count
        $inActive = State::where('status', 0)->count();
        // All Count
        $countAll = State::count();
        
        $this->indexCount(State::class, 'states.index');
        $url = request()->path();
        $segments = explode('/', $url);
        $lastSegment = end($segments);
        $urlName = '/' . $lastSegment;
        $this->indexCount(State::class, $urlName);
        return view('admin.countries.states.index', compact('states','count', 'active', 'inActive', 'countAll'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries =  Country::all();
        return view('admin.countries.states.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateStateRequest $request)
    {
        State::create([
            'country_id' => $request->country_id,
            'state' => $request->state,
            'status' => $request->status

        ]);
        $msg = "State Added Successfully";
        return redirect('admin/states')->with('success', $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $state)
    {
        $countries = Country::all();
        return view('admin.countries.states.edit', compact('state', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStateRequest $request, State $state)
    {
        // return $request->all();
        $state =  State::with('country')->find($state->id);
        $state->update([
            'country_id' => $request->country_id,
            'state' => $request->state,
            'status' => $request->status
        ]);
        $msg = "State Updated Successfully";
        return redirect('admin/states')->with('info', $msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state)
    {
        $state->destroy($state->id);
        $msg = "State Deleted Successfully";
        return redirect('admin/states')->with('error', $msg);
    }

    public function checkBoxDelete(Request $request)
    {
        //dd('checkBoxDelete');
        //dd($request->all());
        $selectedDeleteStateIds = $request->input('selectedDeleteStateIds');
        if (!empty($selectedDeleteStateIds)) {
            $ids = explode(',', $selectedDeleteStateIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $User = State::find($id);
                if ($User) {
                    $User->delete(); // Use delete() method to delete a single record
                }
            }

            return redirect()->back()->with('error', 'Country Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }

    public function activeItem(Request $request)
    {

        //dd('activeItem');
        // dd($request->all());
        $selectedActiveStateIds = $request->input('selectedActiveStateIds');
        if (!empty($selectedActiveStateIds)) {
            $ids = explode(',', $selectedActiveStateIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $User = State::find($id);
                if ($User) {
                    $User->update([
                        'status' => 1
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected Country Activated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
    public function inActiveItem(Request $request)
    {
        //dd('inActiveItem');
        //dd($request->all());
        $selectedInactiveStateIds = $request->input('selectedInactiveStateIds');
        if (!empty($selectedInactiveStateIds)) {
            $ids = explode(',', $selectedInactiveStateIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $User = State::find($id);
                if ($User) {
                    $User->update([
                        'status' => 0
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected Country inActivated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
}
