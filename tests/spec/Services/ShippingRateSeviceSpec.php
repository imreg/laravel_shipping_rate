<?php

namespace spec\App\Services;

use App\Exceptions\ShippingRateException;
use App\Repositories\ShippingRateRepository;
use App\Services\CountryFeeService;
use App\Services\PayloadService;
use PhpSpec\ObjectBehavior;

class ShippingRateSeviceSpec extends ObjectBehavior
{
    function it_returns_UK_payload(ShippingRateRepository $shippingRateRepository)
    {
        $result = [
            'weight' => 30,
            'country_code' => 'UK',
            'shipping_fee' => 56,
            'total' => 116
        ];

        $rule = [
            'name' => 'UK Shipping Rate',
            'country_code' => 'UK',
            'from_value' => 0,
            'to_value' => 60,
            'weight' => 45,
            'shipping_fee' => 56
        ];

        $shippingRateRepository
            ->findByCountry('UK')
            ->willReturn($rule);

        $this->beConstructedWith($shippingRateRepository, new CountryFeeService(new PayloadService()));

        $this->calculate(60, 30, 'UK')->shouldReturn($result);
    }

    function it_returns_FR_payload(ShippingRateRepository $shippingRateRepository)
    {
        $result = [
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

        $shippingRateRepository
            ->findByCountry('FR')
            ->willReturn($rule);

        $this->beConstructedWith($shippingRateRepository, new CountryFeeService(new PayloadService()));

        $this->calculate(60, 30, 'FR')->shouldReturn($result);
    }

    function it_returns_PL_payload(ShippingRateRepository $shippingRateRepository)
    {
        $result = [
            'error' => 'Country doesn\'t have any shipping rates'
        ];

        $shippingRateRepository
            ->findByCountry('PL')
            ->willThrow(ShippingRateException::class);

        $this->beConstructedWith($shippingRateRepository, new CountryFeeService(new PayloadService()));

        $this->calculate(60, 30, 'PL')->shouldReturn($result);
    }
}
