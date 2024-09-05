<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfileIdRequest;
use App\Http\Requests\UpdateProfileIdRequest;
use App\Models\ProfileId;
use Illuminate\Http\Request;
use App\Traits\ModelCountsTrait;


class ProfileIdController extends Controller
{
    use ModelCountsTrait;

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profileIds = ProfileId::orderByDesc('created_at')->paginate(10);
        // Activbe Count
        $active = ProfileId::where('status', 1)->count();
        //Inactive Count
        $inActive = ProfileId::where('status', 0)->count();
        // All Count
        $countAll = ProfileId::count();
        $url = request()->path();
        $segments = explode('/', $url);
        $lastSegment = end($segments);
        $urlName = '/' . $lastSegment;
        
        $this->indexCount(ProfileId::class, $urlName);
        return view('admin.profileids.index', compact('profileIds', 'active', 'inActive', 'countAll'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.profileids.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProfileIdRequest $request)
    {
        ProfileId::create($request->all());
        $msg = "ProfileId Added Successfully";
        return redirect('admin/profileids')->with('success', $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfileId $profileId)

    {
        $profileId = ProfileId::where('status', 1)->get();
        if ($profileId) {
            return view('admin.profileids.show', compact('profileId'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $profileId = ProfileId::find($id);
        return view('admin.profileids.edit', compact('profileId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileIdRequest $request, $id)
    {
        if ($id) {
            $profileId = ProfileId::find($id);
            $profileId->update($request->all());
            $msg = "ProfileId Update Successfully";
            return redirect('admin/profileids')->with('success', $msg);
        } else {
            return redirect()->back()->with('success', 'Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
       
        if ($id) {
           $profileId= ProfileId::find($id);
            $profileId->destroy($id);
           $msg = "ProfileId Deleted Successfully";
            return redirect('admin/profileids')->with('success', $msg);
        } else {
            return redirect()->back()->with('success', 'Something Went Wrong!');
        }
    }
}
