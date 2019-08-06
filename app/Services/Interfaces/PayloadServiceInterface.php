<?php

namespace App\Services\Interfaces;

interface PayloadServiceInterface
{
    /**
     * @param $price
     * @param $weight
     * @param $countryCode
     * @param $shippingFee
     * @param $total
     * @return array
     */
    public function payload($price, $weight, $countryCode, $shippingFee, $total): array;
}
