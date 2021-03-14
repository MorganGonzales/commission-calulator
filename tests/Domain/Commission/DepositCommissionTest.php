<?php

namespace Morgy\CommissionTask\Tests\Domain\Commission;

use Morgy\CommissionTask\Domain\Commission\DepositCommission;
use Morgy\CommissionTask\Domain\Operation;
use PHPUnit\Framework\TestCase;

class DepositCommissionTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_calculate_commission_fee_for_private_user()
    {
        $depositCommission = new DepositCommission();
        $operation = Operation::fromArray(['2016-01-05', 1, 'private', 'deposit', '200.00', 'EUR']);

        $this->assertEquals('0.06', $depositCommission->calculate($operation));
    }

    /**
     * @test
     */
    public function it_should_calculate_commission_fee_for_business_user()
    {
        $depositCommission = new DepositCommission();
        $operation = Operation::fromArray(['2016-01-10', 2, 'business', 'deposit', '10000.00', 'EUR']);

        $this->assertEquals('3.00', $depositCommission->calculate($operation));
    }
}
