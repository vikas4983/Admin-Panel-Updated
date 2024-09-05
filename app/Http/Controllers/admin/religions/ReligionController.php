<?php

namespace App\Http\Controllers\admin\religions;

use App\Http\Controllers\Controller;
use App\Models\Religion;
use Illuminate\Http\Request;
use App\Traits\ModelCountsTrait;


class ReligionController extends Controller
{
    use ModelCountsTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $religions =
        Religion::orderByDesc('created_at')->paginate(10);
        $count = ($religions->currentPage() - 1) * $religions->perPage();
        // Activbe Count
        $active = Religion::where('status', 1)->count();
        //Inactive Count
        $inActive = Religion::where('status', 0)->count();
        // All Count
        $countAll = Religion::count();
        $url = request()->path();
        $segments = explode('/', $url);
        $lastSegment = end($segments);
        $urlName = '/' . $lastSegment;
        
        $this->indexCount(Religion::class, $urlName);
        return view('admin.religions.index', compact('religions','count', 'active', 'inActive', 'countAll'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.religions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Religion::create([
            'religion' => $request->religion,
            'status' => $request->status
        ]);
        $msg = "Religion Added Successfully";

        return redirect('admin/religions')->with('success', $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(Religion $religion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Religion $religion)
    {
        return view('admin.religions.edit', compact('religion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Religion $religion)
    {
        $religion->update([
            'religion' => $request->religion,
            'status' => $request->status
        ]);
        $msg = "Religion Updated Successfully";

        return redirect()->back()->with('info', $msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Religion $religion)
    {
        $religion->destroy($religion->id);
        $msg = "Religion Deleted Successfully";

        return redirect('admin/religions')->with('error', $msg);
    }

    public function checkBoxDelete(Request $request)
    {
        //dd('checkBoxDelete');
        //dd($request->all());
        $selectedDeleteReligionIds = $request->input('selectedDeleteReligionIds');
        if (!empty($selectedDeleteReligionIds)) {
            $ids = explode(',', $selectedDeleteReligionIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $religions = Religion::find($id);
                if ($religions) {
                    $religions->delete(); // Use delete() method to delete a single record
                }
            }

            return redirect()->back()->with('error', 'Selected Religion Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }

    public function activeItem(Request $request)
    {

        //dd('activeItem');
        //dd($request->all());
        $selectedActiveReligionIds = $request->input('selectedActiveReligionIds');
        if (!empty($selectedActiveReligionIds)) {
            $ids = explode(',', $selectedActiveReligionIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $religions = Religion::find($id);
                if ($religions) {
                    $religions->update([
                        'status' => 1
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected Religion Activated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
    public function inActiveItem(Request $request)
    {
        //dd('inActiveItem');
        // dd($request->all());
        $selectedInactiveReligionIds = $request->input('selectedInactiveReligionIds');
        if (!empty($selectedInactiveReligionIds)) {
            $ids = explode(',', $selectedInactiveReligionIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $religions = Religion::find($id);
                if ($religions) {
                    $religions->update([
                        'status' => 0
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected Religion inActivated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
}
