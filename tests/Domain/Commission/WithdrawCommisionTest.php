<?php

namespace Morgy\CommissionTask\Tests\Domain\Commission;

use Morgy\CommissionTask\Domain\Commission\Commission;
use Morgy\CommissionTask\Domain\Commission\WithdrawCommision;
use Morgy\CommissionTask\Domain\Exchange\EurExchangeRate;
use Morgy\CommissionTask\Domain\Operation;
use PHPUnit\Framework\TestCase;

class WithdrawCommisionTest extends TestCase
{
    private Commission $withdrawCommission;

    public function setUp()
    {
        $this->withdrawCommission = new WithdrawCommision(new EurExchangeRate(self::sampleEurRates()));
    }

    /**
     * @test
     */
    public function it_should_calculate_eur_based_commission_fee_for_private_user()
    {
        $operation = Operation::fromArray(['2014-12-31', 4, 'private', 'withdraw', '1200.00', 'EUR']);

        $this->assertEquals('0.60', $this->withdrawCommission->calculate($operation));
    }

    /**
     * @test
     */
    public function it_should_calculate_non_eur_based_commission_fee_for_private_user()
    {
        $operation = Operation::fromArray(['2014-12-31', 4, 'private', 'withdraw', '3000000', 'JPY']);

        $this->assertEquals('8611', $this->withdrawCommission->calculate($operation));
    }

    /**
     * @test
     */
    public function it_should_start_charging_when_A_transaction_exceeds_the_free_limit_within_the_week()
    {
        $operation1 = Operation::fromArray(['2016-01-06', 1, 'private', 'withdraw', '30000', 'JPY']);
        $operation2 = Operation::fromArray(['2016-01-07', 1, 'private', 'withdraw', '1000.00', 'EUR']);
        $operation3 = Operation::fromArray(['2016-01-07', 1, 'private', 'withdraw', '100.00', 'USD']);

        $this->assertEquals('0.00', $this->withdrawCommission->calculate($operation1));
        $this->assertEquals('0.70', $this->withdrawCommission->calculate($operation2));
        $this->assertEquals('0.30', $this->withdrawCommission->calculate($operation3));
    }

    /**
     * @test
     */
    public function it_should_calculate_commission_fee_for_business_user()
    {
        $operation = Operation::fromArray(['2016-01-06', 2, 'business', 'withdraw', '300.00', 'EUR']);

        $this->assertEquals('1.50', $this->withdrawCommission->calculate($operation));
    }

    public function tearDown()
    {
        $reflectedClass = new \ReflectionClass(WithdrawCommision::class);
        $reflectedProperty = $reflectedClass->getProperty('transactionData');
        $reflectedProperty->setAccessible(true);
        $reflectedProperty->setValue([]);
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
            "JPY" => 129.53,
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
            "USD" => 1.1497,
            "MXN" => 24.8556,
            "ILS" => 3.9637,
            "GBP" => 0.85835,
            "KRW" => 1354.93,
            "MYR" => 4.914
        ];
    }
}
