<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\AdminMenu;
use App\Models\Approval;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
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
use App\Models\ModelCount;
use App\Models\Occupation;
use App\Models\Payment;
use App\Models\PaymentGateway;
use App\Models\Plan;
use App\Models\Religion;
use App\Models\State;
use App\Models\ProfileId;
use App\Models\SiteConfig;
use App\Models\SiteSetting;
use App\Models\SpoteLight;
use App\Models\SuccessStory;
use App\Models\TestMenu;
use App\Models\User;
use Carbon\Carbon;
use App\Traits\PaidUsersTrait;
use Illuminate\Support\Facades\Cache;

class CountServiceProvider extends ServiceProvider
{
    use PaidUsersTrait;
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    { {
            View::composer(['layouts.auth','admin.dashboard'], function ($view) {
                $adminMenus = Cache::remember('admin_menus', 60, function () {
                    return    AdminMenu::with('childrenRecursive')->whereNull('parent_id')->where('status', 1)->get();
                });
              $view->with('adminMenus', $adminMenus);
            });
        }
    }
}
