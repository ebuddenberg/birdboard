<?php

namespace App\Providers;

use App\Observers\ProjectObserver;
use App\Project;
use Illuminate\Support\ServiceProvider;
// use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Project::observe(ProjectObserver::class);
    }
}
