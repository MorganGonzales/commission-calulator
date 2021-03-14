<?php

namespace Morgy\CommissionTask\Tests\Domain;

use Morgy\CommissionTask\Domain\Operation;
use PHPUnit\Framework\TestCase;

class OperationTest extends TestCase
{
    private array $sampleData = ['2014-12-31', 4, 'private', 'withdraw', '1200.00', 'EUR'];

    /**
     * @test
     */
    public function it_should_create_an_instance_from_array()
    {
        $operation = Operation::fromArray($this->sampleData);

        $this->assertInstanceOf(Operation::class, $operation);
    }

    /**
     * @test
     */
    public function it_should_retrieve_the_date()
    {
        $operation = Operation::fromArray($this->sampleData);

        $this->assertEquals('2014-12-31', $operation->getDate());
    }

    /**
     * @test
     */
    public function it_should_retrieve_the_user_id()
    {
        $operation = Operation::fromArray($this->sampleData);

        $this->assertEquals(4, $operation->getUserId());
    }

    /**
     * @test
     */
    public function it_should_retrieve_the_user_type()
    {
        $operation = Operation::fromArray($this->sampleData);

        $this->assertEquals('private', $operation->getUserType());
    }

    /**
     * @test
     */
    public function it_should_retrieve_the_operation_type()
    {
        $operation = Operation::fromArray($this->sampleData);

        $this->assertEquals('withdraw', $operation->getType());
    }

    /**
     * @test
     */
    public function it_should_retrieve_the_amount()
    {
        $operation = Operation::fromArray($this->sampleData);

        $this->assertEquals('1200.00', $operation->getAmount());
    }

    /**
     * @test
     */
    public function it_should_retrieve_the_currency()
    {
        $operation = Operation::fromArray($this->sampleData);

        $this->assertEquals('EUR', $operation->getCurrency());
    }
}
