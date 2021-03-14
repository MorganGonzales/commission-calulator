<?php

declare(strict_types=1);

namespace Morgy\CommissionTask\Domain\Exchange;

class EurExchangeRate implements ExchangeRate
{
    private array $rates;

    public function __construct(array $rates)
    {
        $this->rates = $rates;
    }

    public function rates(): array
    {
        return $this->rates;
    }

    public function convert(string $amount, string $currency): string
    {
        return $this->rates()[$currency] ?? false
            ? \strval((float) $amount / $this->rates[$currency])
            : $amount;
    }

    public function revert(string $amount, string $currency): string
    {
        return $this->rates()[$currency] ?? false
            ? \strval((float) $amount * $this->rates[$currency])
            : $amount;
    }
}
