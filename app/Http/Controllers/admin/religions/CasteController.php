<?php

namespace App\Http\Controllers\admin\religions;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\religions\CreateCasteRequest;
use App\Http\Requests\admin\religions\UpdateCasteRequest;
use App\Models\Caste;
use App\Models\Religion;
use Illuminate\Http\Request;
use App\Traits\ModelCountsTrait;


class CasteController extends Controller
{
    use ModelCountsTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $castes = Caste::orderByDesc('created_at')->paginate(10);
        $count = ($castes->currentPage() - 1) * $castes->perPage();
        // Activbe Count
        $active = Caste::where('status', 1)->count();
        //Inactive Count
        $inActive = Caste::where('status', 0)->count();
        // All Count
        $countAll = Caste::count();
        $url = request()->path();
        $segments = explode('/', $url);
        $lastSegment = end($segments);
        $urlName = '/' . $lastSegment;
        
        $this->indexCount(Caste::class, $urlName);
        return view('admin.religions.castes.index', compact('castes','count', 'active', 'inActive', 'countAll'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $religions =  Religion::all();
        return view('admin.religions.castes.create', compact('religions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCasteRequest $request)
    {
        Caste::create([
            'religion_id' => $request->religion_id,
            'caste' => $request->caste,
            'status' => $request->status

        ]);
        $msg = "Caste Added Successfully";
        return redirect('admin/castes')->with('success', $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(Caste $caste)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Caste $caste)
    {
        $religions = Religion::all();
        return view('admin.religions.castes.edit', compact('caste', 'religions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCasteRequest $request, Caste $caste)
    {
        //$state =  State::with('country')->find($state->id);
        $caste->update([
            'religion_id' => $request->religion_id,
            'caste' => $request->caste,
            'status' => $request->status
        ]);
        $msg = "Caste Updated Successfully";
        return redirect('admin/castes')->with('info', $msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Caste $caste)
    {
        $caste->destroy($caste->id);
        $msg = "Caste Deleted Successfully";
        return redirect('admin/castes')->with('error', $msg);
    }
    public function checkBoxDelete(Request $request)
    {
        //dd('checkBoxDelete');
        //dd($request->all());
        $selectedDeleteCasteIds = $request->input('selectedDeleteCasteIds');
        if (!empty($selectedDeleteCasteIds)) {
            $ids = explode(',', $selectedDeleteCasteIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $User = Caste::find($id);
                if ($User) {
                    $User->delete(); // Use delete() method to delete a single record
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
        $selectedActiveCasteIds = $request->input('selectedActiveCasteIds');
        if (!empty($selectedActiveCasteIds)) {
            $ids = explode(',', $selectedActiveCasteIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $User = Caste::find($id);
                if ($User) {
                    $User->update([
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
        // dd($request->all());
        $selectedInactiveCasteIds = $request->input('selectedInactiveCasteIds');
        if (!empty($selectedInactiveCasteIds)) {
            $ids = explode(',', $selectedInactiveCasteIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $User = Caste::find($id);
                if ($User) {
                    $User->update([
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
