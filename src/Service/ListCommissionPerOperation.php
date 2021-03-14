<?php

declare(strict_types=1);

namespace Morgy\CommissionTask\Service;

use Morgy\CommissionTask\Domain\Commission\Commission;
use Morgy\CommissionTask\Domain\Operation;

class ListCommissionPerOperation
{
    private Commission $withdrawCommissionCalculator;

    private Commission $depositCommissionCalculator;

    public function __construct(
        Commission $withdrawCommissionCalculator,
        Commission $depositCommisionCalculator
    ) {
        $this->withdrawCommissionCalculator = $withdrawCommissionCalculator;
        $this->depositCommissionCalculator = $depositCommisionCalculator;
    }

    public function execute(Operation ...$operations): array
    {
        return \array_map(function (Operation $operation) {
            return $operation->getType() === 'withdraw'
                ? $this->withdrawCommissionCalculator->calculate($operation)
                : $this->depositCommissionCalculator->calculate($operation);
        }, $operations);
    }
}
