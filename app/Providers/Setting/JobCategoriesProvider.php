<?php

namespace App\Providers\Setting;

use Illuminate\Support\ServiceProvider;
use App\Model\JobCategories;

class JobCategoriesProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){
            $view->with('jobCats', JobCategories::orderBy('category_name', 'ASC')->get());
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
