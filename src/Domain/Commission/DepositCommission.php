<?php

declare(strict_types=1);

namespace Morgy\CommissionTask\Domain\Commission;

use Morgy\CommissionTask\Domain\Operation;

class DepositCommission extends Commission
{
    private const COMMISSION_PERCENTAGE = 0.03;

    public function calculate(Operation $operation): string
    {
        return $this->roundUp(
            \strval((self::COMMISSION_PERCENTAGE / 100) * $operation->getAmount()),
            $this->countDecimals($operation->getAmount())
        );
    }
}
