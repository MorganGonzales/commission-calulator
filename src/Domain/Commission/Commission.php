<?php

declare(strict_types=1);

namespace Morgy\CommissionTask\Domain\Commission;

use Morgy\CommissionTask\Domain\Operation;

abstract class Commission
{
    abstract public function calculate(Operation $operation): string;

    protected function roundUp(string $number, int $decimals): string
    {
        return number_format(ceil($number * 100) / 100, $decimals, '.', '');
    }

    protected function countDecimals(string $number): int
    {
        if (!$position = \strpos($number, '.')) {
            return 0;
        }

        return strlen($number) - ($position + 1);
    }
}
