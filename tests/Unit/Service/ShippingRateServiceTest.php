<?php
declare(strict_types=1);

namespace Tests\Unit\Service;

use App\Exceptions\ShippingRateException;
use App\Repositories\ShippingRateRepository;
use App\Services\CountryFeeService;
use App\Services\PayloadService;
use App\Services\ShippingRateSevice;
use Tests\TestCase;

class ShippingRateServiceTest extends TestCase
{
    public function testCalculation()
    {
        $expectation = [
            'price' => 60,
            'weight' => 30,
            'country_code' => 'FR',
            'shipping_fee' => 30,
            'total' => 90
        ];

        $rule = [
            'name' => 'FR Shipping Rate',
            'country_code' => 'FR',
            'from_value' => 0,
            'to_value' => 50,
            'weight' => 40,
            'shipping_fee' => 30
        ];

        $shippingRateRepository = $this->createMock(ShippingRateRepository::class);
        $shippingRateRepository->expects($this->any())
            ->method('findByCountry')
            ->with('FR')
            ->willReturn($rule);

        $shippingRateService = new ShippingRateSevice($shippingRateRepository,
            new CountryFeeService(new PayloadService()));

        $result = $shippingRateService->calculate(60, 30, 'FR');
        $this->assertEquals($result, $expectation);
    }

    public function testCalculationException()
    {
        $shippingRateRepository = $this->createMock(ShippingRateRepository::class);
        $shippingRateRepository->expects($this->any())
            ->method('findByCountry')
            ->with('PL')
            ->willThrowException(new ShippingRateException());

        $shippingRateService = new ShippingRateSevice($shippingRateRepository,
            new CountryFeeService(new PayloadService()));
        $result = $shippingRateService->calculate(60, 30, 'PL');

        $expectation = [
            'error' => 'Country doesn\'t have any shipping rates'
        ];
        $this->assertEquals($result, $expectation);
    }
}
