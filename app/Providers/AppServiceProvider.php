<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        $this->app->singleton('App\Repositories\IUserRepository', 'App\Repositories\Ad\AdUserRepository');
        $this->app->singleton('App\Repositories\IComputerRepository', 'App\Repositories\Ad\AdComputerRepository');
        $this->app->singleton('App\Repositories\IDepartmentRepository', 'App\Repositories\Ad\AdDepartmentRepository');
    }
}
