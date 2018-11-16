<?php

namespace App\Providers\Setting;

use Illuminate\Support\ServiceProvider;
use App\Model\Status;

class StatusProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){
            $view->with('statusSet', Status::all());
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
