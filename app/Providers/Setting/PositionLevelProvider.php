<?php

namespace App\Providers\Setting;

use Illuminate\Support\ServiceProvider;
use App\Model\PositionLevel;

class PositionLevelProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    { 
        view()->composer('*', function($view){
            $view->with('poslvl_array', PositionLevel::orderBy('post_level', 'ASC')->get());
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
