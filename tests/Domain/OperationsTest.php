<?php

namespace Morgy\CommissionTask\Tests\Domain;

use Morgy\CommissionTask\Domain\Operation;
use Morgy\CommissionTask\Domain\Operations;
use PHPUnit\Framework\TestCase;

class OperationsTest extends TestCase
{
    public function testInstanceIsIteratorAggregate()
    {
        $this->assertInstanceOf(\IteratorAggregate::class, new Operations());
    }

    public function testInstanceIsCountable()
    {
        $this->assertInstanceOf(\Countable::class, new Operations());
    }

     public function testCreateOperatorAggregateFromArray()
     {
         $operations = Operations::fromArray(self::sampleArrayData());

         $this->assertCount(3, $operations);

         foreach ($operations as $operation) {
             $this->assertInstanceOf(Operation::class, $operation);
         }
     }

     public function testIntegrityOfEachItemCreated()
     {
         $operations = Operations::fromArray(self::sampleArrayData());
         $operationsArray = \array_map(function ($data) {
             return Operation::fromArray($data);
         }, self::sampleArrayData());

         $index = 0;
         foreach ($operations as $operation) {
             $this->assertEquals($operation, $operationsArray[$index]);
             $index++;
         }
     }

    /**
     * @test
     */
     public function it_should_return_an_array_of_Operation()
     {
         $operations = Operations::fromArray(self::sampleArrayData());

         $this->assertCount(3, $operations->toArray());
     }

     private static function sampleArrayData(): array
     {
         return [
             [
                 '2014-12-31',
                 4,
                 'private',
                 'withdraw',
                 '1200.00',
                 'EUR',
             ],
             [
                 '2015-01-01',
                 4,
                 'private',
                 'withdraw',
                 '1000.00',
                 'EUR',
             ],
             [
                 '2016-01-05',
                 4,
                 'private',
                 'withdraw',
                 '1000.00',
                 'EUR',
             ],
         ];
     }
}
