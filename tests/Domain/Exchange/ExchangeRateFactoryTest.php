<?php

namespace Morgy\CommissionTask\Tests\Domain\Exchange;

use Morgy\CommissionTask\Domain\Exchange\EurExchangeRate;
use Morgy\CommissionTask\Domain\Exchange\ExchangeRateFactory;
use PHPUnit\Framework\TestCase;

class ExchangeRateFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_return_an_instance_of_EurExchangeRage()
    {
        $instance = ExchangeRateFactory::create('eur');

        $this->assertInstanceOf(EurExchangeRate::class, $instance);
    }

    /**
     * @test
     */
    public function it_should_throw_an_InvalidArgumentException_if_given_currency_is_missing()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('ExchangeRate instance for `USD` is not registered/existing');

        ExchangeRateFactory::create('usd');
    }

    /**
     * @test
     */
    public function it_should_throw_an_InvalidArgumentException_if_given_currency_is_empty()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('ExchangeRate instance for `` is not registered/existing');

        ExchangeRateFactory::create('');
    }
}
