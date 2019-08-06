<?php

namespace spec\App\Services;

use App\Services\PayloadService;
use PhpSpec\ObjectBehavior;

class CountryFeeServiceSpec extends ObjectBehavior
{
    function it_return_JP_payload()
    {
        $result = [
            'price' => 40,
            'country_code' => "JP",
            'shipping_fee' => 70,
            'total' => 110
        ];

        $rule = [
            'name' => 'JP Shipping Rate',
            'country_code' => 'JP',
            'from_value' => 0,
            'to_value' => 50,
            'weight' => 20,
            'shipping_fee' => 70
        ];

        $this->beConstructedWith(new PayloadService());
        //if price > from_value and price <= to_value, weight is ignored
        $this->japanRule(40, 50, $rule)->shouldReturn($result);
    }

    function it_return_UK_payload()
    {
        $result = [
            'weight' => 30,
            'country_code' => "UK",
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

        $this->beConstructedWith(new PayloadService());
        //if provided weight < ShippingRate weight, price is ignored.
        $this->ukRule(60, 30, $rule)->shouldReturn($result);
    }

    function it_return_MX_payload()
    {
        $rule = [
            'name' => 'MX Shipping Rate',
            'country_code' => 'MX',
            'from_value' => 0,
            'to_value' => 70,
            'weight' => 55,
            'shipping_fee' => 40
        ];

        $result = [
            'price' => 60,
            'weight' => 50,
            'country_code' => "MX",
            'shipping_fee' => 40,
            'total' => 100
        ];

        $this->beConstructedWith(new PayloadService());
        $this->mxRule(60, 50, $rule)->shouldReturn($result);
    }
}
