<?php

namespace App\Providers\Setting;

use Illuminate\Support\ServiceProvider;
use App\Model\Candidate;

class CandidateProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){
            $view->with('candidateSet', Candidate::all());
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
