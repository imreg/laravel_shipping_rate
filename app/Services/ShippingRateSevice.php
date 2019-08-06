<?php

namespace App\Services;

use App\Exceptions\ShippingRateException;
use App\Repositories\Interfaces\ShippingRateRepositoryInterface;
use App\Services\Interfaces\CountryFeeServiceInterface;
use App\Services\Interfaces\ShippingRateServiceInterface;

class ShippingRateSevice implements ShippingRateServiceInterface
{
    /**
     * @var ShippingRateRepositoryInterface
     */
    private $shippingRateRepository;

    /**
     * @var CountryFeeServiceInterface
     */
    private $countryFeeService;

    /**
     * ShippingRateSevice constructor.
     * @param ShippingRateRepositoryInterface $shippingRateRepository
     * @param CountryFeeServiceInterface $countryFeeService
     */
    public function __construct(
        ShippingRateRepositoryInterface $shippingRateRepository,
        CountryFeeServiceInterface $countryFeeService
    ) {
        $this->shippingRateRepository = $shippingRateRepository;
        $this->countryFeeService = $countryFeeService;
    }

    /**
     * @inheritDoc
     */
    public function calculate(int $price, int $weight, string $countryCode): ?array
    {
        try {
            $result = $this->shippingRateRepository->findByCountry($countryCode);
        } catch (ShippingRateException $exception) {
            return ['error' => $exception->getMessage()];
        }

        switch ($countryCode) {
            case 'JP':
                return $this->countryFeeService->japanRule($price, $weight, $result);
            case 'UK':
                return $this->countryFeeService->ukRule($price, $weight, $result);
            default:
                return $this->countryFeeService->mxRule($price, $weight, $result);
        }
    }
}
