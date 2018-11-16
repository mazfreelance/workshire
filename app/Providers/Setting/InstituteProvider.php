<?php

namespace App\Providers\Setting;

use Illuminate\Support\ServiceProvider;
use App\Model\Institute;

class InstituteProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){
            $view->with('institutes', Institute::orderby('uni_name', 'ASC')->get());
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
