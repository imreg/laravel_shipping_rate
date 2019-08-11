<?php

namespace App\Providers;

use App\Repositories\Interfaces\ShippingRepositoryInterface;
use App\Repositories\ShippingRepository;
use App\Services\Interfaces\ShippingServiceInterface;
use App\Services\ShippingService;
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
        $this->app->bind(
            ShippingServiceInterface::class,
            ShippingService::class
        );

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
