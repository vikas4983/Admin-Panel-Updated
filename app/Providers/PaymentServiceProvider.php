<?php

namespace App\Providers;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
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
        //
        View::composer('layouts.auth', function ($view) {
            // Retrieve and pass the active plan to admin views
            if (Auth::user()) {
                $activePlan = Payment::latest('created_at', 'desc')->first();
                $view->with('activePlan', $activePlan);
                //dd($activePlan);
            } 
            else  {
                $free = Auth::user();
                $free = Payment::where('created_at', '');
                $view->with('free', $free);

            } 
            
           
            
        });
    }
}
