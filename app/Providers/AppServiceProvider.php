<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        //cara sharing localhost

        //run di CMD "winget install --id Cloudflare.cloudflared"

        //aktifin codingan ini:
        // if (app()->environment('local')) {
        //     URL::forceScheme('https');
        // }

        //run di CMD "cloudflared tunnel --url http://127.0.0.1:8000 --protocol http2
    }
}
