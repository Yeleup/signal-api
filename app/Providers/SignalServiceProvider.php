<?php

namespace App\Providers;

use App\Gateways\SignalGateway;
use App\Services\SignalService;
use Illuminate\Support\ServiceProvider;

class SignalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SignalService::class, function ($app) {
            $gateway = new SignalGateway(config('services.signal.base_url'), config('services.signal.number'));
            return new SignalService($gateway);
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
