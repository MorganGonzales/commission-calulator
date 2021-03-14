<?php

namespace Morgy\CommissionTask\Tests\Service;

use Morgy\CommissionTask\Domain\Commission\Commission;
use Morgy\CommissionTask\Domain\Operation;
use Morgy\CommissionTask\Domain\Operations;
use Morgy\CommissionTask\Service\ListCommissionPerOperation;
use PHPUnit\Framework\TestCase;

class ListCommissionPerOperationTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_return_an_array_of_strings_that_represent_commission_fee_of_each_operation()
    {
        $withdrawCommissionCalculator = $this->createMock(Commission::class);
        $withdrawCommissionCalculator->method('calculate')->willReturn('0.00', '10.23', '20.34');

        $depositCommisionCalculator = $this->createMock(Commission::class);
        $depositCommisionCalculator->method('calculate')->willReturn('1.00', '2.00', '3.00');

        $operation = $this->createMock(Operation::class);
        $operation->method('getType')->willReturn('withdraw', 'withdraw', 'deposit', 'withdraw', 'deposit', 'deposit');

        $operations = $this->createMock(Operations::class);
        $operations->method('toArray')->willReturn([$operation, $operation, $operation, $operation, $operation, $operation]);

        $service = new ListCommissionPerOperation($withdrawCommissionCalculator, $depositCommisionCalculator);
        $result = $service->execute(...$operations->toArray());

        $this->assertNotEmpty($result);
        $this->assertEquals(['0.00', '10.23', '1.00', '20.34', '2.00', '3.00'], $result);
    }
}
