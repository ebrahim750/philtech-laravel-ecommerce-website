<?php

namespace Webkul\HydraTechTheme\Providers;

use Illuminate\Support\ServiceProvider;

class HydraTechThemeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'hydra-tech-theme');
    }
}
