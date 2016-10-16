<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Guard;
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

        $this->app->bind('GuzzleHttp\Client', function ($app) {
            $guard = $this->app->make(Guard::class);
            $todoApiKey = $guard->user()->todo_api_key;
            return new \GuzzleHttp\Client([
                'base_uri' => $app['config']['redmine']['base_uri'],
                'headers' =>['X-Redmine-API-Key' => $todoApiKey]
           ]);
        });
    }
}
