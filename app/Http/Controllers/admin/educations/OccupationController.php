<?php

namespace App\Http\Controllers\admin\educations;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\educations\CreateOccupationRequest;
use App\Http\Requests\admin\educations\UpdateOccupationRequest;
use App\Models\Employee;
use App\Models\Occupation;
use Illuminate\Http\Request;

class OccupationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $occupations = Occupation::orderByDesc('created_at')->paginate(10);
        $count = ($occupations->currentPage() - 1) * $occupations->perPage();
        // Activbe Count
        $active = Occupation::where('status', 1)->count();
        //Inactive Count
        $inActive = Occupation::where('status', 0)->count();
        // All Count
        $countAll = Occupation::count();
        return view('admin.employees.occupations.index', compact('occupations', 'count', 'active', 'inActive', 'countAll'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees =  Employee::all();
        return view('admin.employees.occupations.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOccupationRequest $request)
    {
        Occupation::create([
            'employee_id' => $request->employee_id,
            'occupation' => $request->occupation,
            'status' => $request->status

        ]);
        $msg = "Occupation Added Successfully";
        return redirect('admin/occupations')->with('success', $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(Occupation $occupation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Occupation $occupation)
    {
        $employees = Employee::all();
        return view('admin.employees.occupations.edit', compact('occupation', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOccupationRequest $request, Occupation $occupation)
    {

        $occupation->update([
            'employee_id' => $request->employee_id,
            'occupation' => $request->occupation,
            'status' => $request->status
        ]);
        $msg = "Occupation Updated Successfully";
        return redirect('admin/occupations')->with('info', $msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Occupation $occupation)
    {
        $occupation->destroy($occupation->id);
        $msg = "Occupation Deleted Successfully";
        return redirect('admin/occupations')->with('error', $msg);
    }
    public function checkBoxDelete(Request $request)
    {
        //dd('checkBoxDelete');
        //dd($request->all());
        $selectedDeleteOccupationIds = $request->input('selectedDeleteOccupationIds');
        if (!empty($selectedDeleteOccupationIds)) {
            $ids = explode(',', $selectedDeleteOccupationIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $occupations = Occupation::find($id);
                if ($occupations) {
                    $occupations->delete(); // Use delete() method to delete a single record
                }
            }

            return redirect()->back()->with('error', 'Selected Occupation Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }

    public function activeItem(Request $request)
    {

        //dd('activeItem');
        //dd($request->all());
        $selectedActiveOccupationIds = $request->input('selectedActiveOccupationIds');
        if (!empty($selectedActiveOccupationIds)) {
            $ids = explode(',', $selectedActiveOccupationIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $occupations = Occupation::find($id);
                if ($occupations) {
                    $occupations->update([
                        'status' => 1
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected Occupation Activated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
    public function inActiveItem(Request $request)
    {
        //dd('inActiveItem');
        // dd($request->all());
        $selectedInactiveOccupationIds = $request->input('selectedInactiveOccupationIds');
        if (!empty($selectedInactiveOccupationIds)) {
            $ids = explode(',', $selectedInactiveOccupationIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $occupations = Occupation::find($id);
                if ($occupations) {
                    $occupations->update([
                        'status' => 0
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected Occupation inActivated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
}
