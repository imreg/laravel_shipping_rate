<?php

namespace App\Repositories;

use App\Exceptions\ShippingRateException;
use App\Repositories\Interfaces\ShippingRateRepositoryInterface;
use App\ShippingRate;

class ShippingRateRepository implements ShippingRateRepositoryInterface
{
    /**
     * @var ShippingRate
     */
    private $shippingRate;

    /**
     * ShippingRateRepository constructor.
     * @param ShippingRate $shippingRate
     */
    public function __construct(ShippingRate $shippingRate)
    {
        $this->shippingRate = $shippingRate;
    }

    /**
     * @inheritDoc
     */
    public function findByCountry(string $countryCode): ?array
    {
        $result = $this->shippingRate
            ->where('country_code', '=', $countryCode)
            ->take(1)
            ->get()
            ->toArray();

        if (count($result) === 0) {
            throw new ShippingRateException('Error: ' . $countryCode . ' doesn\'t have any shipping rates');
        }

        return $result[0];
    }
}
