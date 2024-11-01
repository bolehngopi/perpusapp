<?php

namespace App\Providers;

use App\Http\Middleware\RoleMiddleware;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
    }

    // public function configureMiddleware($middleware)
    // {
    //     $middleware->map([
    //         'role' => RoleMiddleware::class, // Register your custom middleware here
    //     ]);
    // }
}
