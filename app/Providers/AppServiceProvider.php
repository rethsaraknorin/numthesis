<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Add this import
use App\Http\ViewComposers\AdminLayoutComposer; // Add this import

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
        // Use the AdminLayoutComposer for the admin layout view
        View::composer('components.admin-layout', AdminLayoutComposer::class);
    }
}