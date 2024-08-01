<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSiteConfigRequest;
use App\Http\Requests\UpdateSiteConfigRequest;
use App\Models\SiteConfig;
use Illuminate\Http\Request;

class SiteConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siteConfigs = siteConfig::orderByDesc('created_at')->paginate(10);
        //    // Activbe Count
        //     $active = Menu::where('status', 1)->count();
        //     //Inactive Count
        //     $inActive = Menu::where('status', 0)->count();
        //     // All Count
        //     $countAll = Menu::count();
        return view('admin.siteConfigs.index', compact('siteConfigs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.siteConfigs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSiteConfigRequest $request)
    {
        siteConfig::create($request->all());
        $msg = "Site Config  Added Successfully";
        return redirect('admin/siteConfigs')->with('success', $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(SiteConfig $siteConfig)
    {
        $siteConfigs = SiteConfig::all();

        // foreach($siteConfigs as $siteConfig){
        //   $aboutMe= $siteConfig->demo1;

        // }

        return view('admin.siteConfigs.show', compact('siteConfig'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SiteConfig $siteConfig)
    {
        return view('admin.siteConfigs.edit', compact('siteConfig'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiteConfigRequest $request, SiteConfig $siteConfig)
    {
        if ($siteConfig) {
            $siteConfig->update($request->all());
            $msg = "Site Config  Update Successfully";
            return redirect('admin/siteConfigs')->with('success', $msg);
        } else {
            return redirect()->back()->with('success', 'Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SiteConfig $siteConfig)
    {
        if ($siteConfig) {
            $siteConfig->destroy($siteConfig->id);
            $msg = "Site Config  Deleted Successfully";
            return redirect('admin/siteConfigs')->with('success', $msg);
        } else {
            return redirect()->back()->with('success', 'Something Went Wrong!');
        }
    }
}
