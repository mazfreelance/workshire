<?php

namespace App\Providers\Setting;
use App\Model\Salary;
use Illuminate\Support\ServiceProvider;

class SalaryProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){
            $view->with('salarys', Salary::all());
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
