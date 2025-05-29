<?php

namespace App\Providers;

use routes;

use App\Models\User;
use Laravel\Passport\Passport;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Passport::loadKeysFrom(__DIR__ . '/../secrets/oauth');
        Passport::ignoreRoutes();
        // Gate::define('is-admin', function (User $user) {
        //     return $user === Auth::id();
        // });
    }
}
