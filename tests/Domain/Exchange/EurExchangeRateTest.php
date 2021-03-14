<?php

namespace Morgy\CommissionTask\Tests\Domain\Exchange;

use Morgy\CommissionTask\Domain\Exchange\EurExchangeRate;
use Morgy\CommissionTask\Domain\Exchange\ExchangeRate;
use PHPUnit\Framework\TestCase;

class EurExchangeRateTest extends TestCase
{
    private EurExchangeRate $instance;

    public function setUp()
    {
        $this->instance = new EurExchangeRate(self::sampleEurRates());
    }

    public function testInstanceIsExchangeRate()
    {
        $this->assertInstanceOf(ExchangeRate::class, $this->instance);
    }

    public function testConvertFromUsd()
    {
        $usdToEur = $this->instance->convert('100', 'USD');

        $this->assertEquals('83.801223497863', $usdToEur);
    }

    public function testConvertFromJpy()
    {
        $jpyToEur = $this->instance->convert('30000', 'JPY');

        $this->assertEquals('230.52097740894', $jpyToEur);
    }

    /**
     * @test
     */
    public function it_should_return_the_same_amount_if_given_currency_is_the_base_currency()
    {
        $eurToEur = $this->instance->convert('1000', 'EUR');

        $this->assertEquals('1000', $eurToEur);
    }

    /**
     * @test
     */
    public function it_should_return_the_same_amount_if_given_currency_is_invalid()
    {
        $eurToEur = $this->instance->convert('12345', 'invalid-currency');

        $this->assertEquals('12345', $eurToEur);
    }

    /**
     * @test
     */
    public function it_should_return_the_same_amount_if_given_currency_is_empty()
    {
        $eurToEur = $this->instance->convert('12345', '');

        $this->assertEquals('12345', $eurToEur);
    }

    /**
     * @test
     */
    public function it_should_allow_conversion_to_its_base_currency()
    {
        $eurToJpy = $this->instance->revert('22160.65', 'JPY');

        $this->assertEquals('2883986.9910', $eurToJpy);
    }

    private static function sampleEurRates(): array
    {
        return [
            "CAD" => 1.4975,
            "HKD" => 9.2642,
            "ISK" => 153.9,
            "PHP" => 57.772,
            "DKK" => 7.4366,
            "HUF" => 366.18,
            "CZK" => 26.15,
            "AUD" => 1.5394,
            "RON" => 4.885,
            "SEK" => 10.1388,
            "IDR" => 17174.63,
            "INR" => 86.726,
            "BRL" => 6.6421,
            "RUB" => 87.703,
            "HRK" => 7.5885,
            "JPY" => 130.14,
            "THB" => 36.73,
            "CHF" => 1.1094,
            "SGD" => 1.6053,
            "PLN" => 4.5867,
            "BGN" => 1.9558,
            "TRY" => 9.0452,
            "CNY" => 7.7636,
            "NOK" => 10.0863,
            "NZD" => 1.6633,
            "ZAR" => 17.8505,
            "USD" => 1.1933,
            "MXN" => 24.8556,
            "ILS" => 3.9637,
            "GBP" => 0.85835,
            "KRW" => 1354.93,
            "MYR" => 4.914
        ];
    }

}
