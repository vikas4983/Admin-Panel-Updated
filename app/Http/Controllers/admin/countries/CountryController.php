<?php

namespace App\Http\Controllers\admin\countries;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\countries\CreateCountryRequest;
use App\Http\Requests\admin\countries\UpdateCountryRequest;
use App\Models\Country;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use App\Traits\ModelCountsTrait;


class CountryController extends Controller
{
    use ModelCountsTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // countries view
        $countries = Country::orderByDesc('created_at')->paginate(10);
        $count = ($countries->currentPage() - 1) * $countries->perPage();
        // Activbe Count
        $active = Country::where('status', 1)->count();
        //Inactive Count
        $inActive = Country::where('status', 0)->count();
        // All Count
        $countAll = Country::count();
        $url = request()->path();
        $segments = explode('/', $url);
        $lastSegment = end($segments);
        $urlName = '/' . $lastSegment;
        $this->indexCount(Country::class, $urlName);
        return view('admin.countries.index', compact('countries', 'count', 'active', 'inActive', 'countAll'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->createCount(Country::class, 'countries.create');
        return view('admin.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCountryRequest $request)
    {
        //dd($request->all());
        Country::create([
            'country' => $request->country,
            'status' => $request->status
        ]);

        $msg = "Country Added Successfully";

        //return redirect('admin/countries')->with('success', $msg);
        return redirect('admin/countries')->with('success', $msg);
    }



    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Country $country)
    {
        return view('admin.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country->update([
            'country' => $request->country,
            'status' => $request->status
        ]);
        $msg = "Country Updated Successfully";

        return redirect('admin/countries')->with('info', $msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country,)
    {

        $country->destroy($country->id);
        $msg = "Country Deleted Successfully";

        return redirect('admin/countries')->with('error', $msg);
    }

    public function checkBoxDelete(Request $request)
    {
        // dd($request->all());
        $selectedInactiveCountryIds = $request->input('selectedInactiveCountryIds');
        if (!empty($selectedInactiveCountryIds)) {
            $ids = explode(',', $selectedInactiveCountryIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $User = Country::find($id);
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

        //dump('country');
        // dd($request->all());
        $selectedActiveCountryIds = $request->input('selectedActiveCountryIds');
        if (!empty($selectedActiveCountryIds)) {
            $ids = explode(',', $selectedActiveCountryIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $User = Country::find($id);
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
        //dd($request->all());
        //selectedInactiveCountryIds
        $selectedInactiveCountryIds = $request->input('selectedInactiveCountryIds');
        if (!empty($selectedInactiveCountryIds)) {
            $ids = explode(',', $selectedInactiveCountryIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $User = Country::find($id);
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
