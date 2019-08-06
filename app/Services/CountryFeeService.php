<?php


namespace App\Services;

use App\Services\Interfaces\CountryFeeServiceInterface;
use App\Services\Interfaces\PayloadServiceInterface;

class CountryFeeService implements CountryFeeServiceInterface
{

    /**
     * @var PayloadServiceInterface
     */
    private $payloadService;

    /**
     * CountryFeeService constructor.
     * @param PayloadServiceInterface $payloadService
     */
    public function __construct(PayloadServiceInterface $payloadService)
    {
        $this->payloadService = $payloadService;
    }

    /**
     * @inheritDoc
     */
    public function japanRule(int $price, int $weight, array $rule): ?array
    {
        $payload = $this->payloadService
            ->payload($price, $weight, $rule['country_code'], $rule['shipping_fee'], $price + $rule['shipping_fee']);

        //if price > from_value and price <= to_value, weight is ignored
        if ($price > $rule['from_value'] && $price <= $rule['to_value']) {
            unset($payload['weight']);
        }

        return $payload;
    }

    /**
     * @inheritDoc
     */
    public function ukRule(int $price, int $weight, array $rule): ?array
    {
        $payload = $this->payloadService
            ->payload($price, $weight, $rule['country_code'], $rule['shipping_fee'], $price + $rule['shipping_fee']);

        //if provided weight < ShippingRate weight, price is ignored.
        if ($weight < $rule['weight']) {
            unset($payload['price']);
        }

        return $payload;
    }

    /**
     * @inheritDoc
     */
    public function mxRule(int $price, int $weight, array $rule): array
    {
        $shippingFee = 0;

        //if price > from_value and price <= to_value or provided weight < ShippingRate weight
        if ($price > $rule['from_value'] && $price <= $rule['to_value']
            || $weight < $rule['to_value']) {
            $shippingFee = $rule['shipping_fee'];
        }

        return $this->payloadService->payload(
            $price,
            $weight,
            $rule['country_code'],
            $shippingFee,
            $price + $shippingFee
        );
    }
}
