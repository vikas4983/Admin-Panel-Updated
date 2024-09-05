<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCmsPageRequest;
use App\Models\cmsPage;
use Illuminate\Http\Request;
use App\Traits\ModelCountsTrait;


class CmsPageController extends Controller
{
    use ModelCountsTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cmspages = cmsPage::orderByDesc('created_at')->paginate(10);
        //$countCmsPages = ($cmspages->currentPage() - 1) * $cmspages->perPage();
        // Activbe Count
        $active = cmsPage::where('status', 1)->count();
        //Inactive Count
        $inActive = cmsPage::where('status', 0)->count();
        // All Count
        $countAll = cmsPage::count();
        $url = request()->path();
        $segments = explode('/', $url);
        $lastSegment = end($segments);
        $urlName = '/' . $lastSegment;
        
        $this->indexCount(cmsPage::class, $urlName);
        return view('admin.cmspages.index', compact('cmspages', 'active', 'inActive', 'countAll'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cmspages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,)
    {
        //dd($request->all());
        cmsPage::create($request->all());
        $smg = "CMS Page Created Successfully!";
        return redirect('admin/cmsPages')->with('success', $smg);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        // Fetch the page from the database based on the slug
        $cmsPage = cmsPage::where('slug', $slug)->firstOrFail();
        if($cmsPage){
            return view('admin.cmsPages.show', compact('cmsPage'));
        }
        else{
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
        
        // Pass the page data to the view
       
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cmsPage = cmsPage::find($id);
        return view('admin.cmsPages.edit', compact('cmsPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cmsPage = cmsPage::find($id);
        if ($cmsPage) {
            $cmsPage->update($request->all());
            return redirect('admin/cmsPages')->with('success', 'CMS Page Updated Successfully!');
        }
    }

    public function destroy($id)
    {
        $cmspage = cmsPage::find($id);
        if ($cmspage) {
            $cmspage->destroy($id);
            return redirect('admin/cmsPages')->with('error', 'CMS Page deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong!.');
        }
    }

    public function checkBoxDelete(Request $request)
    {
        //dd($request->all());
        $selectedDeleteCMSIds = $request->input('selectedDeleteCMSIds');
        if (!empty($selectedDeleteCMSIds)) {
            $ids = explode(',', $selectedDeleteCMSIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $cmsPage = cmsPage::find($id);
                if ($cmsPage) {
                    $cmsPage->delete(); // Use delete() method to delete a single record
                }
            }

            return redirect()->back()->with('error', 'Selected items deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }

    public function activeItem(Request $request)
    {    //dd("active");
   // dd($request->all());
        $selectedActiveCMSIds = $request->input('selectedActiveCMSIds');
        if (!empty($selectedActiveCMSIds)) {
            $ids = explode(',', $selectedActiveCMSIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $cmsPage = cmsPage::find($id);
                if ($cmsPage) {
                    $cmsPage->update([
                        'status' => 1
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected items Activated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
    public function inActiveItem(Request $request)
    {    //dd("active");
        //dd($request->all());
        $selectedInactiveCMSIds = $request->input('selectedInactiveCMSIds');
        if (!empty($selectedInactiveCMSIds)) {
            $ids = explode(',', $selectedInactiveCMSIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $cmsPage = cmsPage::find($id);
                if ($cmsPage) {
                    $cmsPage->update([
                        'status' => 0
                    ]);
                }
            }
            //dd('vikas');
            return redirect()->back()->with('success', 'Selected items inActivated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
}
