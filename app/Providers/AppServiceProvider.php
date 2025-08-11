<?php

namespace App\Providers;

use App\Contracts\Production\ProductionServiceInterface;
use App\Contracts\User\UserServiceInterface;
use App\Http\Controllers\Service\Production\ProductionService;
use App\Http\Controllers\Service\User\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserServiceInterface::class,
            UserService::class
        );

        $this->app->bind(
            ProductionServiceInterface::class,
            ProductionService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
