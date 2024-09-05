<?php

namespace App\Http\Controllers;

use App\Models\AdminMenu;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminMenuRequest;
use App\Http\Requests\UpdateAdminMenuRequest;
use App\Models\Country;
use App\Models\Menu;
use App\Traits\ModelCountsTrait;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    use ModelCountsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $adminMenus = AdminMenu::with('children')->whereNull('parent_id')->paginate(10);;
        $count = ($adminMenus->currentPage() - 1) * $adminMenus->perPage();
        $url = request()->path();
        $segments = explode('/', $url);
        $lastSegment = end($segments);
        $urlName = '/' . $lastSegment;
       
        $this->indexCount(AdminMenu::class, $urlName);
        return view('admin.adminMenus.index', compact('adminMenus', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $adminMenus = AdminMenu::whereNull('parent_id')->with('children')->get();
        $url = $request->path();
        $menuName = 'Create';
        //$this->createCount(AdminMenu::class, $url, $menuName);
        return view("admin.adminMenus.create", compact("adminMenus"));
        //return view("admin.adminMenus.create", compact("menus"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminMenuRequest $request)
    {  
        $adminMenu = AdminMenu::create($request->all());
        //$abc->update($this->indexCount(Country::class));
        return redirect()->back()->with('success', 'Menu created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdminMenu $adminMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminMenu $adminMenu)
    {
        $adminMenu = AdminMenu::find($adminMenu->id);
        $parentMenus = AdminMenu::whereNull('parent_id')->get();
       return view('admin.adminMenus.edit', compact('adminMenu','parentMenus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminMenuRequest $request, AdminMenu $adminMenu)
    {   
        $adminMenu->update($request->all());
        return redirect('admin/adminMenus')->with('success', 'Menu updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,  AdminMenu $adminMenu)
    {      //dd($request->all());
        $adminMenu->destroy($adminMenu->id);
        return redirect('admin/adminMenus')->with('success', 'Menu deleted successfully');
    }
}
