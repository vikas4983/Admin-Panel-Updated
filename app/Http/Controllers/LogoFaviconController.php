<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\Favicon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Traits\ModelCountsTrait;


class LogoFaviconController extends Controller
{
    use ModelCountsTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logos = Logo::orderByDesc('created_at')->paginate(10);
        $favicons = Favicon::orderByDesc('created_at')->paginate(10);
        $countLogo = ($logos->currentPage() - 1) * $logos->perPage();
        // Activbe Count
        $active = Logo::where('status', 1)->count();
        //Inactive Count
        $inActive = Logo::where('status', 0)->count();
        // All Logos
        $countAll = Logo::count();
        $url = request()->path();
        $segments = explode('/', $url);
        $lastSegment = end($segments);
        $urlName = '/' . $lastSegment;
        
        $this->indexCount(Logo::class, $urlName);
        return view('admin.logos.index', compact('logos', 'favicons','countLogo',  'active', 'inActive', 'countAll'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.logos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $logo = $request->file('logo');
        $validateLogo = $request->validate(
            [
                'logo' => ['required', 'image', 'mimes:jpeg,jpg,png,gif'],
                'status' => ['required']
            ]
        );

        if ($validateLogo) {
            $logoName = rand(100, 1000) . time() . $logo->getClientOriginalName();
            $filePath = public_path('storage/admin/logo-favicon/logos/');
            $logo->move($filePath, $logoName);
            $previouseLogos = Logo::all();
            if ($request->status == 1) {
                $newLogo = Logo::create([
                    'name' => $logoName,
                    'status' => $request->status,
                ]);
                foreach ($previouseLogos as $previouseLogo) {
                    if ($newLogo->id != $previouseLogo->id) {
                        $previouseLogo->update([
                            'status' => 0
                        ]);
                    }
                }
            } else {
                $newLogo = Logo::create([
                    'name' => $logoName,
                    'status' => $request->status,
                ]);
            }
            return redirect('admin/logos')->with('success', 'Logo Uploaded Successfully!');
        } else {
            return redirect('admin.logos')->back()->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $logo = Logo::find($id);
        return view('admin.logos.edit', compact('logo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $logos = Logo::find($id);
        //dd($logos);
        $validateLogo = $request->validate(
            [
                'logo' => ['required', 'image', 'mimes:jpeg,jpg,png,gif'],
                'status' => ['required', 'numeric'],
            ]
        );
        $logo = $request->file('logo');



        if ($validateLogo) {

            $logoName = rand(100, 1000) . time() . $logo->getClientOriginalName();
            $filePath = public_path('storage/admin/logo-favicon/logos');
            $logo->move($filePath, $logoName);

            $previousFilePathLogo = $filePath . $logos->name;
            if (File::exists($previousFilePathLogo)) {
                File::delete($previousFilePathLogo);
            }
            $logos->update([
                'name' => $logoName,
                'status' => $request->status,
            ]);

            $previousLogos = Logo::all();
            foreach ($previousLogos as $previousLogo) {
                if ($id != $previousLogo->id) {
                    $previousLogo->update([
                        
                        'status' => 0
                    ]);
                }
                if ($logos) {
                    $logos->update([
                      
                        'status' => $request->status,
                    ]);
                }
            }
            return redirect('admin/logos')->with('success', 'Logo Uploaded Successfully!');
        } else {
            return redirect()->back()->with('error', 'Please Select al least One Filed!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $logo = Logo::find($id);

        if ($logo) {
            $logo->destroy($id); // Corrected method name to delete the logo
          // Check if there's only one logo remaining
            if (Logo::count() === 1) {
                // Find the last remaining logo and activate it
                Logo::where('id', '!=', $id)->update([
                    'status' => 1
                ]);
            }

            $msg = "Logo Deleted Successfully";
            return redirect('admin/logos')->with('error', $msg);
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
        
       
        
    }
    public function checkBoxDelete(Request $request)
    {
        //dd('checkBoxDelete');
        //dd($request->all());
        $selectedDeleteLogoIds = $request->input('selectedDeleteLogoIds');
        if (!empty($selectedDeleteLogoIds)) {
            $ids = explode(',', $selectedDeleteLogoIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $logos = Logo::find($id);
                if ($logos) {
                    $logos->delete(); // Use delete() method to delete a single record
                }
            }

            return redirect()->back()->with('error', 'Selected Logo Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }

    public function activeItem(Request $request)
    {

        //dd('activeItem');
        //dd($request->all());
        $selectedActiveLogoIds = $request->input('selectedActiveLogoIds');
        if (!empty($selectedActiveLogoIds)) {
            $ids = explode(',', $selectedActiveLogoIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $logos = Logo::find($id);
                if ($logos) {
                    $logos->update([
                        'status' => 1
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected Logo Activated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
    public function inActiveItem(Request $request)
    {
        //dd('inActiveItem');
        // dd($request->all());
        $selectedInactiveLogoIds = $request->input('selectedInactiveLogoIds');
        if (!empty($selectedInactiveLogoIds)) {
            $ids = explode(',', $selectedInactiveLogoIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $logos = Logo::find($id);
                if ($logos) {
                    $logos->update([
                        'status' => 0
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected Logo inActivated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
}
