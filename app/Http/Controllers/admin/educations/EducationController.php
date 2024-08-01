<?php

namespace App\Http\Controllers\admin\educations;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educations =
            Education::orderByDesc('created_at')->paginate(10);
        $count = ($educations->currentPage() - 1) * $educations->perPage();
        // Activbe Count
        $active = Education::where('status', 1)->count();
        //Inactive Count
        $inActive = Education::where('status', 0)->count();
        // All Count
        $countAll = Education::count();
        return view('admin.educations.index', compact('educations', 'count', 'active', 'inActive', 'countAll'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.educations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request->all();
        Education::create([
            'education' => $request->education,
            'status' => $request->status
        ]);
        $msg = "Education Added Successfully";
        return redirect('admin/educations')->with('success', $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(Education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Education $education)
    {
        return view('admin.educations.edit', compact('education'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Education $education)
    {
        $education->update([
            'education' => $request->education,
            'status' => $request->status
        ]);
        $msg = "Education Updated Successfully";
        return redirect('admin/educations')->with('info', $msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Education $education)
    {
        $education->destroy($education->id);
        $msg = "Education  Deleted Successfully";
        return redirect('admin/educations')->with('error', $msg);
    }
    public function checkBoxDelete(Request $request)
    {
        //dd('checkBoxDelete');
        //dd($request->all());
        $selectedDeleteEducationIds = $request->input('selectedDeleteEducationIds');
        if (!empty($selectedDeleteEducationIds)) {
            $ids = explode(',', $selectedDeleteEducationIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $educations = Education::find($id);
                if ($educations) {
                    $educations->delete(); // Use delete() method to delete a single record
                }
            }

            return redirect()->back()->with('error', 'Selected Education Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }

    public function activeItem(Request $request)
    {

        //dd('activeItem');
        //dd($request->all());
        $selectedActiveEducationIds = $request->input('selectedActiveEducationIds');
        if (!empty($selectedActiveEducationIds)) {
            $ids = explode(',', $selectedActiveEducationIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $educations = Education::find($id);
                if ($educations) {
                    $educations->update([
                        'status' => 1
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected Education Activated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
    public function inActiveItem(Request $request)
    {
        //dd('inActiveItem');
        // dd($request->all());
        $selectedInactiveEducationIds = $request->input('selectedInactiveEducationIds');
        if (!empty($selectedInactiveEducationIds)) {
            $ids = explode(',', $selectedInactiveEducationIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $educations = Education::find($id);
                if ($educations) {
                    $educations->update([
                        'status' => 0
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected Education inActivated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
}
