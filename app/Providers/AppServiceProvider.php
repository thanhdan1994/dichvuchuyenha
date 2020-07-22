<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $information = DB::table('settings')->where('slug', 'information')->pluck('value')->first();
        $information = explode('|', $information);
        View::share('addressGlobal', $information[0]);
        View::share('phoneGlobal', $information[1]);
        View::share('emailGlobal', $information[2]);
    }
}
