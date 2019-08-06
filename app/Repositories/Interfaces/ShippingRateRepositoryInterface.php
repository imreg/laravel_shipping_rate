<?php


namespace App\Repositories\Interfaces;

use App\Exceptions\ShippingRateException;

interface ShippingRateRepositoryInterface
{
    /**
     * @param string $countryCode
     * @return array|null
     * @throws ShippingRateException
     */
    public function findByCountry(string $countryCode): ?array;
}
