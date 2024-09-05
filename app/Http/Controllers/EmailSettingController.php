<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmailSettingRequest;
use App\Http\Requests\UpdateEmailSettingRequest;
use App\Models\EmailSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\ModelCountsTrait;


class EmailSettingController extends Controller
{
    use ModelCountsTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emailSettings = EmailSetting::orderByDesc('created_at')->paginate(10);
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
        
        $this->indexCount(EmailSetting::class, $urlName);
        return view('admin.emailSettings.index', compact('emailSettings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.emailSettings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEmailSettingRequest $request)
    {
        //dd($request->all());

        $data = $request->all();
        $data['password']= Hash::make($data['password']);
        EmailSetting::create($data);
        $msg = "Email Setting Added Successfully";
        return redirect('admin/emailSettings')->with('success', $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(EmailSetting $emailSetting)
    {
        // $menus = Menu::where('status', 1)->get();
        // if ($menu) {
        //     return view('admin.menus.show', compact('menu', 'menus'));
        // }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmailSetting $emailSetting)
    {
        return view('admin.emailSettings.edit', compact('emailSetting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmailSettingRequest $request, EmailSetting $emailSetting)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        
        if ($emailSetting) {
            $emailSetting->update($data);
            $msg = "Email Setting Update Successfully";
            return redirect('admin/emailSettings')->with('success', $msg);
        } else {
            return redirect()->back()->with('success', 'Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmailSetting $emailSetting)
    {
        if ($emailSetting) {
            $emailSetting->destroy($emailSetting->id);
            $msg = "Email Setting Deleted Successfully";
            return redirect('admin/emailSettings')->with('success', $msg);
        } else {
            return redirect()->back()->with('success', 'Something Went Wrong!');
        }
    }
}
