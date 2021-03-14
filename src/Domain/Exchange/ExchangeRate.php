<?php

declare(strict_types=1);

namespace Morgy\CommissionTask\Domain\Exchange;

interface ExchangeRate
{
    public function rates(): array;

    public function convert(string $amount, string $currency): string;

    public function revert(string $amount, string $currency): string;
}
