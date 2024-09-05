<?php

namespace App\Http\Controllers;

use App\Models\Favicon;
use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Traits\ModelCountsTrait;

class FaviconController extends Controller
{
    use ModelCountsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $logos = Logo::orderByDesc('created_at')->paginate(10);
        // $countLogo = ($logos->currentPage() - 1) * $logos->perPage();
        $favicons = Favicon::orderByDesc('created_at')->paginate(10);
        $countFavicon = ($favicons->currentPage() - 1) * $favicons->perPage();
        // Activbe Count
        $active = Favicon::where('status', 1)->count();
        //Inactive Count
        $inActive = Favicon::where('status', 0)->count();
        // All Count
        $countAll = Favicon::count();
        $url = request()->path();
        $segments = explode('/', $url);
        $lastSegment = end($segments);
        $urlName = '/' . $lastSegment;
      
        $this->indexCount(Favicon::class, $urlName);
        return view('admin.favicons.index', compact('favicons', 'countFavicon', 'active', 'inActive', 'countAll'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.favicons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $favicon = $request->file('favicon');
        $validateFavicon = $request->validate(
            [
                'favicon' => ['required', 'image', 'mimes:jpeg,jpg,png,gif'],
                'status' => ['required', 'numeric'],
            ]
        );
        $previousFavicons = Favicon::all();

        if ($validateFavicon) {
            $FaviconName = rand(100, 1000) . time() . $favicon->getClientOriginalName();
            $filePath = public_path('storage/admin/logo-favicon/favicons/');
            $favicon->move($filePath, $FaviconName);

            if ($request->status == 1) {
                $newFavicon = Favicon::create([
                    'name' => $FaviconName,
                    'status' => $request->status,
                ]);

                foreach ($previousFavicons as $previousFavicon) {
                    if ($newFavicon->id != $previousFavicon->id) {
                        $previousFavicon->update([
                            'status' => 0
                        ]);
                    }
                }
            }

            return redirect('admin/favicons')->with('success', 'Favicon Uploaded Successfully!');
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Favicon $favicon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $favicon = Favicon::find($id);
        return view('admin.favicons.edit', compact('favicon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $validateFavicon = $request->validate(
            [
                'favicon' => ['required', 'image', 'mimes:jpeg,jpg,png,gif'],
                'status' => ['required', 'numeric'],
            ]
        );
        $favicon = $request->file('favicon');
        $favicons = Favicon::find($id);
        $faviconName = rand(100, 1000) . time() . $favicon->getClientOriginalName();
        $filePath = public_path('storage/admin/logo-favicon/favicons');
        $favicon->move($filePath, $faviconName);

        if ($validateFavicon) {
            $previousFilePathFavicon = $filePath . $favicons->name;
            if (File::exists($previousFilePathFavicon)) {
                File::delete($previousFilePathFavicon);
            }
            $favicons->update([
                'name' => $faviconName,
                'status' => $request->status,
            ]);

            $previousFavicons = Favicon::all();
            foreach ($previousFavicons as $previousFavicon) {
                if ($id != $previousFavicon->id) {
                    $previousFavicon->update([

                        'status' => 0
                    ]);
                }
                if ($favicons) {
                    $favicons->update([

                        'status' => $request->status,
                    ]);
                }
            }
            return redirect('admin/favicons')->with('success', 'Favicon Uploaded Successfully!');
        } else {
            return redirect()->back()->with('error', 'Please Select al least One Filed!');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {


        $favicons = Favicon::find($id);

        if ($favicons) {
            $favicons->destroy($id);
            $msg = "Favicon Deleted Successfully";
            if (Favicon::count() === 1) {
                // Find the last remaining logo and activate it
                Favicon::where('id', '!=', $id)->update([
                    'status' => 1
                ]);
            }

            return redirect('admin/favicons')->with('error', $msg);
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
    public function checkBoxDelete(Request $request)
    {
        //dd('checkBoxDelete');
        //dd($request->all());
        $selectedDeleteFaviconIds = $request->input('selectedDeleteFaviconIds');
        if (!empty($selectedDeleteFaviconIds)) {
            $ids = explode(',', $selectedDeleteFaviconIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $favicons = Favicon::find($id);
                if ($favicons) {
                    $favicons->delete(); // Use delete() method to delete a single record
                }
            }

            return redirect()->back()->with('error', 'Selected Favicon Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }

    public function activeItem(Request $request)
    {

        //dd('activeItem');
        //dd($request->all());
        $selectedActiveFaviconIds = $request->input('selectedActiveFaviconIds');
        if (!empty($selectedActiveFaviconIds)) {
            $ids = explode(',', $selectedActiveFaviconIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $favicons = Favicon::find($id);
                if ($favicons) {
                    $favicons->update([
                        'status' => 1
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected Favicon Activated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
    public function inActiveItem(Request $request)
    {
        //dd('inActiveItem');
        // dd($request->all());
        $selectedInactiveFaviconIds = $request->input('selectedInactiveFaviconIds');
        if (!empty($selectedInactiveFaviconIds)) {
            $ids = explode(',', $selectedInactiveFaviconIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $favicons = Favicon::find($id);
                if ($favicons) {
                    $favicons->update([
                        'status' => 0
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected Favicon inActivated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
}
