<?php

namespace App\Providers;

// use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

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
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        Gate::define('admin', function (User $user){
            return $user->is_admin; //hanya admin yang dapat akses middleware admin
        });

        Gate::define('dokter', function (User $user){
            return $user->is_admin; //hanya dokter yang dapat akses middleware admin
        });

        Gate::define('administrasi', function (User $user){
            return $user->is_admin; //hanya administrasi yang dapat akses middleware admin
        });

        Gate::define('farmasi', function (User $user){
            return $user->is_admin; //hanya farmasi yang dapat akses middleware admin
        });
    }
}
