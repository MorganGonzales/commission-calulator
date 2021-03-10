<?php

namespace Morgy\CommissionTask\Tests\Domain;

use Morgy\CommissionTask\Domain\Operation;
use PHPUnit\Framework\TestCase;

class OperationTest extends TestCase
{
    private $sampleData = [
        '2014-12-31',
        4,
        'private',
        'withdraw',
        '1200.00',
        'EUR',
    ];

    public function testCreateInstanceFromArray()
    {
        $operation = Operation::fromArray($this->sampleData);

        $this->assertInstanceOf(Operation::class, $operation);
    }

    public function testGetTransactionDate()
    {
        $operation = Operation::fromArray($this->sampleData);

        $this->assertEquals('2014-12-31', $operation->getDate());
    }

    public function testGetUserId()
    {
        $operation = Operation::fromArray($this->sampleData);

        $this->assertEquals(4, $operation->getUserId());
    }

    public function testGetUserType()
    {
        $operation = Operation::fromArray($this->sampleData);

        $this->assertEquals('private', $operation->getUserType());
    }

    public function testGetType()
    {
        $operation = Operation::fromArray($this->sampleData);

        $this->assertEquals('withdraw', $operation->getType());
    }

    public function testGetAmount()
    {
        $operation = Operation::fromArray($this->sampleData);

        $this->assertEquals('1200.00', $operation->getAmount());
    }

    public function testGetCurrency()
    {
        $operation = Operation::fromArray($this->sampleData);

        $this->assertEquals('EUR', $operation->getCurrency());
    }
}
