<?php

namespace App\Providers\Setting;
use App\Model\State;
use Illuminate\Support\ServiceProvider;

class StateProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){
            $view->with('state_array', State::orderBy('state_name', 'asc')->get());
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
