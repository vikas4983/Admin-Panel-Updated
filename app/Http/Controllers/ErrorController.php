<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function error(Request $request){
        //dd($request->all());
        return view('error');
    }
}
