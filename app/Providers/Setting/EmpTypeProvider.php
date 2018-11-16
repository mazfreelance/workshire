<?php

namespace App\Providers\Setting;

use Illuminate\Support\ServiceProvider;
use App\Model\EmpType;

class EmpTypeProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){
            $view->with('empType_array', EmpType::orderBy('emp_type', 'ASC')->get());
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
