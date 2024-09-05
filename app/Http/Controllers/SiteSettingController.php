<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSiteSettingRequest;
use App\Http\Requests\UpdateSiteSettingRequest;
use Illuminate\Http\Request;
use App\Traits\ModelCountsTrait;

class SiteSettingController extends Controller
{
    use ModelCountsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siteSettings = SiteSetting::orderByDesc('created_at')->paginate(10);
        //    // Activbe Count
        //     $active = Menu::where('status', 1)->count();
        //     //Inactive Count
        //     $inActive = Menu::where('status', 0)->count();
        //     // All Count
        //     $countAll = Menu::count();
        $url = request()->path();
        $segments = explode('/', $url);
        $lastSegment = end($segments);
        $urlName = '/' . $lastSegment;
        $this->indexCount(SiteSetting::class, $urlName);
        return view('admin.siteSettings.index', compact('siteSettings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.siteSettings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSiteSettingRequest $request)
    {
        SiteSetting::create($request->all());
        $msg = "Site Setting Added Successfully";
        return redirect('admin/siteSettings')->with('success', $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(SiteSetting $siteSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SiteSetting $siteSetting)
    {
        return view('admin.siteSettings.edit', compact('siteSetting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiteSettingRequest $request, SiteSetting $siteSetting)
    {
        if ($siteSetting) {
            $siteSetting->update($request->all());
            $msg = "Site Setting Update Successfully";
            return redirect('admin/siteSettings')->with('success', $msg);
        } else {
            return redirect()->back()->with('success', 'Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SiteSetting $siteSetting)
    {
        if ($siteSetting) {
            $siteSetting->destroy($siteSetting->id);
            $msg = "Site Setting Deleted Successfully";
            return redirect('admin/siteSettings')->with('success', $msg);
        } else {
            return redirect()->back()->with('success', 'Something Went Wrong!');
        }
    }
}
