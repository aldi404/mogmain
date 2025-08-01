<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libs\Whatsapp\WhatsappService;

class WhatsappProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('whatsapp', function ($app) {
            return new WhatsappService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
