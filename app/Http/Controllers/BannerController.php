<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBannerRequest;
use App\Models\Banner;
use App\Models\cmsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderByDesc('created_at')->paginate(10);
        // $countLogo = ($banners->currentPage() - 1) * $banners->perPage();
        // Activbe Count
        $active = Banner::where('status', 1)->count();
        //Inactive Count
        $inActive = Banner::where('status', 0)->count();
        // All Logos
        $countAll = Banner::count();
        return view('admin.banners.index', compact('banners', 'active', 'inActive', 'countAll'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           // dd("vikas");


        $file = $request->file('banner');
        $validateBanner = $request->validate(
            [
                'banner' => ['required', 'image', 'mimes:jpeg,jpg,png,gif'],
                'status' => ['required','in:0,1']
            ]
        );
       

        if ($validateBanner) {
            $bannerName = rand(100, 1000) . time() . $file->getClientOriginalName();
            $filePath = public_path('storage/admin/banners/');
            $file->move($filePath, $bannerName);
            // $previousebanners = Banner::all();
            // if ($request->status == 1) {
            //     $newbanner = banner::create([
            //         'name' => $bannerName,
            //         'status' => $request->status,
            //     ]);
            //     foreach ($previousebanners as $previousebanner) {
            //         if ($newbanner->id != $previousebanner->id) {
            //             $previousebanner->update([
            //                 'status' => 0
            //             ]);
            //         }
            //     }
            // } else {
            //     $newbanner = banner::create([
            //         'name' => $bannerName,
            //         'status' => $request->status,
            //     ]);
            // }
               Banner::create([
                'name'=> $bannerName,
                'status' =>$request->status,
            ]);

            return redirect('admin/banners')->with('success', 'Banner Uploaded Successfully!');
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)

    {
       $cmsPages= cmsPage::where('status',1)->get();
        $banner = Banner::find($id);
        return view('admin.banners.show', compact('banner', 'cmsPages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $banner = Banner::find($id);
        //dd($banner);

        return view('admin.banners.edit', compact('banner'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $banners = Banner::find($id);

        if ($file = $request->file('banner')) {
            $bannerName = rand(100, 1000) . time() . $file->getClientOriginalName();
            $filePath = public_path('storage/admin/banners/');
            $file->move($filePath, $bannerName);

            // Assuming $admin is already defined and represents the user you are updating
            $previousFilePath = $filePath . $banners->name;

            if (File::exists($previousFilePath)) {
                File::delete($previousFilePath);
            }
            $banners->update([
                'name' => $bannerName,
                'status' => $request->status,
                
            ]);

             return redirect('admin/banners')->with('success', 'Banner Updated Successfully!');
        } else {
            $banners->update([
                'status' => $request->status,
                
            ]);
            return redirect('admin/banners')->with('success', 'Banner Updated Successfully!');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
      
        // dd($banner);
        if ($banner) {
            $banner->destroy($banner->id); // Corrected method name to delete the logo
            // Check if there's only one logo remaining
            if (Banner::count() === 1) {
                // Find the last remaining logo and activate it
                Banner::where('id', '!=', $banner->id)->update([
                    'status' => 1
                ]);
            }

            $msg = "Banner Deleted Successfully";
            return redirect('admin/banners')->with('error', $msg);
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
}
