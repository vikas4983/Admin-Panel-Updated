<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayUController extends Controller
{
    public function plan()
    {
        // dd($_REQUEST);
        $plans = Plan::all();
        // check admin is login

        // if (Auth::user()) {
        //     $admin = Auth::user();
        //     // dd("AP 01", $admin);
        // } elseif (!Auth::user()) {
        //     $msg = " Dear User Login First";
        //     return redirect()->back()->with('error', $msg);
        // }

       // return view('admin.plans.plan', compact('plans', 'admin'));
        return view('admin.plans.plan', compact('plans'));
    }
}
