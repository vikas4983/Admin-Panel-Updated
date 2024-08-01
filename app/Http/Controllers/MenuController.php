<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::orderByDesc('created_at')->paginate(10);
        //Header Menu
        $headers = Menu::where('section', 1)->orderByDesc('created_at')->paginate(10);
        // dd($headers);
        //Footer Menu
        $footers = Menu::where('section', 0)->orderByDesc('created_at')->paginate(10);
        // Activbe Count
        $active = Menu::where('status', 1)->count();
        //Inactive Count
        $inActive = Menu::where('status', 0)->count();
        // All Count
        $countAll = Menu::count();
        return view('admin.menus.index', compact('menus', 'active', 'inActive', 'countAll', 'headers', 'footers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMenuRequest $request)
    {
        //dd($request->all());
        Menu::create($request->all());
        $msg = "Menu Added Successfully";
        return redirect('admin/menus')->with('success', $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {

        $menus = Menu::where('section', 1)->where('status', 1)->get();
        $footers = Menu::where('section', 0)->where('status', 1)->get();
        //dd($menus);
        if ($menu) {
            return view('admin.menus.show', compact( 'menus', 'footers'));
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {

        return view('admin.menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        if ($menu) {
            $menu->update($request->all());
            $msg = "Menu Update Successfully";
            return redirect('admin/menus')->with('success', $msg);
        } else {
            return redirect()->back()->with('success', 'Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        if ($menu) {
            $menu->destroy($menu->id);
            $msg = "Menu Deleted Successfully";
            return redirect('admin/menus')->with('success', $msg);
        } else {
            return redirect()->back()->with('success', 'Something Went Wrong!');
        }
    }
}
