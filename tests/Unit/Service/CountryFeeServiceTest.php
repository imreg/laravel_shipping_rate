<?php


namespace Tests\Unit\Service;


use App\Services\CountryFeeService;
use App\Services\PayloadService;
use Tests\TestCase;

class CountryFeeServiceTest extends TestCase
{
    /**
     * @var CountryFeeService
     */
    private $countryFeeService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->countryFeeService = new CountryFeeService(new PayloadService());
    }

    public function testJpRule()
    {
        $expectation = [
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

        $result = $this->countryFeeService->japanRule(40, 50, $rule);
        $this->assertEquals($expectation, $result);
    }

    public function testUkRule()
    {
        $expectation = [
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

        $result = $this->countryFeeService->ukRule(60, 30, $rule);
        $this->assertEquals($expectation, $result);
    }

    public function testMxRule()
    {
        $expectation = [
            'price' => 60,
            'weight' => 50,
            'country_code' => "MX",
            'shipping_fee' => 40,
            'total' => 100
        ];

        $rule = [
            'name' => 'MX Shipping Rate',
            'country_code' => 'MX',
            'from_value' => 0,
            'to_value' => 70,
            'weight' => 55,
            'shipping_fee' => 40
        ];

        $result = $this->countryFeeService->mxRule(60, 50, $rule);
        $this->assertEquals($expectation, $result);
    }
}
