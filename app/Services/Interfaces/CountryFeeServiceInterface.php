<?php

namespace App\Services\Interfaces;

interface CountryFeeServiceInterface
{
    /**
     * @param int $price
     * @param int $weight
     * @param string $countryCode
     * @return array|null
     */
    public function japanRule(int $price, int $weight, array $rule): ?array;
    public function ukRule(int $price, int $weight, array $rule): ?array;
    public function mxRule(int $price, int $weight, array $rule): ?array;
}
