<?php

namespace App\Providers\Setting;

use Illuminate\Support\ServiceProvider;
use App\Model\Education_Level;

class EducationLvlProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){
            $view->with('edulvl_array', Education_Level::all());
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
