<?php

namespace App\Http\Controllers;

use App\Http\Controllers\admin_auth\AdminController;
use App\Models\Admin;
use App\Models\Approval;
use App\Models\Banner;
use App\Models\Caste;
use App\Models\City;
use App\Models\cmsPage;
use App\Models\Country;
use App\Models\Education;
use App\Models\EmailSetting;
use App\Models\Employee;
use App\Models\Favicon;
use App\Models\Income;
use App\Models\Logo;
use App\Models\Menu;
use App\Models\Occupation;
use App\Models\Plan;
use App\Models\Religion;
use App\Models\State;
use App\Models\ProfileId;
use App\Models\SiteConfig;
use App\Models\SiteSetting;
use App\Models\SuccessStory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()

    {
        //dd(Auth::guard('admin')->user()->roll);

        
       $count = [
            'admins' => Admin::count(),
            'countries' => Country::count(),
            'states' => State::count(),
            'cities' => City::count(),
            'religions' => Religion::count(),
            'castes' => Caste::count(),
            'educations' => Education::count(),
            'employees' => Employee::count(),
            'occupations' => Occupation::count(),
            'incomes' => Income::count(),
            'plans' => Plan::count(),
            'cmsPages' => cmsPage::count(),
            'logos' => Logo::count(),
            'favicons' => Favicon::count(),
            'banners' => Banner::count(),
            'menus' => Menu::count(),
            'profileids' => ProfileId::count(),
            'emailSettings' => EmailSetting::count(),
            'siteSettings' => SiteSetting::count(),
            'siteConfigs' => SiteConfig::count(),
            'approvals' => Approval::count(),
            'successStories' => SuccessStory::count(),
        ];
        return view('admin.dashboard', compact('count'));

        // $admins =  User::count();
        // $countries =  Country::count();
        // $states =  State::count();
        // $cities =  City::count();
        // $religions =  Religion::count();
        // $castes =  Caste::count();
        // $educations =  Education::count();
        // $employees =  Employee::count();
        // $occupations =  Occupation::count();
        // $incomes =  Income::count();
        // $plans =  Plan::count();
        // $cmsPages =  cmsPage::count();
        // $logos =  Logo::count();
        // $favicons =  Favicon::count();
        // $banners =  Banner::count();
        // $menus =  Menu::count();
        // $profileids = ProfileId::count();
        // $emailSettings = EmailSetting::count();
        // $siteSettings = SiteSetting::count();
        // $siteConfigs = SiteConfig::count();
        // $approvals = Approval::count();
        // return view('dashboard', compact('countries', 'states', 'cities', 'religions', 'castes', 'educations', 'employees', 'occupations', 'incomes', 'admins', 'plans', 'cmsPages','logos','favicons', 'banners', 'menus', 'profileids', 'emailSettings', 'siteSettings', 'siteConfigs', 'approvals'))->with('success', 'Admin Logged in Successfully!');
    }
}
