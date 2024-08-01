<?php

namespace App\Providers;

use App\Models\Payment;
use App\Models\Plan;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PaidPlanServiceProvider extends ServiceProvider
{
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
        View::composer('admin.plans.plan', function ($view) {
            $paidPlan = Payment::latest('plan_id', 'desc')->first();
            
            $view->with('paidPlan', $paidPlan);
        });
    }
}
