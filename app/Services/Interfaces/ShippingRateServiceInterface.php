<?php

namespace App\Services\Interfaces;

interface ShippingRateServiceInterface
{
    /**
     * @param int $price
     * @param int $weight
     * @param string $countryCode
     * @return array|null
     */
    public function calculate(int $price, int $weight, string $countryCode): ?array;
}
