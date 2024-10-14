<?php

namespace App\Providers;

use App\Contracts\OrderValidatorInterface;
use App\Services\OrderValidator;
use App\Contracts\OrderTransformerInterface;
use App\Services\OrderTransformer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OrderValidatorInterface::class, OrderValidator::class);
        $this->app->bind(OrderTransformerInterface::class, OrderTransformer::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
