<?php

namespace App\Providers\Setting;

use Illuminate\Support\ServiceProvider; 

class EducationCatProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){
            $view->with('eduCats', 
                            \DB::table('education_category') 
                            ->select('*')->where('parent_cat', '=', '')->orderby('category_Name', 'ASC')->get()
                        );
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
