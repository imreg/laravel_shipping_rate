<?php

namespace App\Providers;

use App\Repositories\Interfaces\ShippingRateRepositoryInterface;
use App\Repositories\ShippingRateRepository;
use App\Services\CountryFeeService;
use App\Services\Interfaces\CountryFeeServiceInterface;
use App\Services\Interfaces\PayloadServiceInterface;
use App\Services\Interfaces\ShippingRateServiceInterface;
use App\Services\PayloadService;
use App\Services\ShippingRateSevice;
use Illuminate\Support\ServiceProvider;

class ShippingRateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ShippingRateServiceInterface::class,
            ShippingRateSevice::class
        );

        $this->app->bind(
            ShippingRateRepositoryInterface::class,
            ShippingRateRepository::class
        );

        $this->app->bind(
            CountryFeeServiceInterface::class,
            CountryFeeService::class
        );

        $this->app->bind(
            PayloadServiceInterface::class,
            PayloadService::class
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
