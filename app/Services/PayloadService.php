<?php

namespace App\Services;

use App\Services\Interfaces\PayloadServiceInterface;

class PayloadService implements PayloadServiceInterface
{
    /**
     * @inheritDoc
     */
    public function payload($price, $weight, $countryCode, $shippingFee, $total): array
    {
        return [
            'price' => $price,
            'weight' => $weight,
            'country_code' => $countryCode,
            'shipping_fee' => $shippingFee,
            'total' => $total
        ];
    }
}
