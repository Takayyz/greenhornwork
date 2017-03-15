<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $repositories = [
            // \App\Repositories\UserRepository::class,
            \App\Repositories\UserInfosRepository::class,
            \App\Repositories\DairyReportsRepository::class,
            \App\Repositories\AdminUsersRepository::class,
            \App\Repositories\WorkSchedulesRepository::class,
            \App\Repositories\StoresRepository::class,  
        ];
 
        foreach ($repositories as $repository) {
            $this->app->bind($repository, $repository.'Eloquent');
        }
    }
}