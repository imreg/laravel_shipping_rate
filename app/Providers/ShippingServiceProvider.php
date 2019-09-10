<?php

namespace App\Providers;

use App\Repositories\Interfaces\ShippingRepositoryInterface;
use App\Repositories\ShippingRepository;
use Illuminate\Support\ServiceProvider;

class ShippingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(\App\Http\Controllers\ShippingController::class)
            ->needs(\App\Services\Interfaces\ShippingServiceInterface::class)
            ->give(\App\Services\ShippingService::class);

        $this->app->bind(
            ShippingRepositoryInterface::class,
            ShippingRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
