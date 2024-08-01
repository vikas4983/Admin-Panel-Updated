<?php

namespace App\Providers;

use App\Models\Favicon;
use App\Models\Logo;
use App\Models\LogoFavicon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class LogoFaviconServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        View::composer('layouts.auth', function ($view) {
            //$logofavicons = LogoFavicon::where('status', 1)->first();
            //$logofavicons = LogoFavicon::where('status', 1)->latest()->first();
            $logos = Logo::where('status', 1)->orderBy('id', 'desc')->first();
            $favicons = Favicon::where('status', 1)->orderBy('id', 'desc')->first();
            $view->with('logos', $logos)->with('favicons', $favicons);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
