<?php

namespace App\Providers;

use App\Models\Admin;
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
use App\Models\User;
use Carbon\Carbon;
use App\Traits\PaidUsersTrait;

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
    {
        View::composer('layouts.auth', function ($view) {
            
            $counts = [
                'adminsCount' => Admin::count(),
                'countriesCount' => Country::count(),
                'statesCount' => State::count(),
                'citiesCount' => City::count(),
                'religionsCount' => Religion::count(),
                'castesCount' => Caste::count(),
                'educationsCount' => Education::count(),
                'employeesCount' => Employee::count(),
                'occupationsCount' => Occupation::count(),
                'incomesCount' => Income::count(),
                'plansCount' => Plan::count(),
                'cmsPagesCount' => cmsPage::count(),
                'logosCount' => Logo::count(),
                'faviconsCount' => Favicon::count(),
                'bannersCount' => Banner::count(),
                'menusCount' => Menu::count(),
                'profileidsCount' => ProfileId::count(),
                'emailSettingsCount' => EmailSetting::count(),
                'siteSettingsCount' => SiteSetting::count(),
                'paymentgatewaysCount' => PaymentGateway::count(),
                'siteConfigsCount' => SiteConfig::count(),
                'approvalsCount' => Approval::count(),
                'successStoriesCount' => SuccessStory::count(),
                'usersCount' => User::count(),
                'activeUsersCount' => User::where('status', 1)->count(),
                'inActiveUsersCount' => User::where('status', 0)->count(),
                'paidUsersCount' => count($this->paidUsers()),
                'spotlightCount' => SpoteLight::where('is_spote_light', 1)->count(),
               
               
            ];
            
            $view->with('counts', $counts);
        });
    }
}
