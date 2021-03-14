<?php

declare(strict_types=1);

namespace Morgy\CommissionTask\Domain\Exchange;

class ExchangeRateFactory
{
    private static array $exchangeRateMap = [
        'EUR' => EurExchangeRate::class,
    ];

    public static function create(string $currency): ExchangeRate
    {
        $exchangeRateClassName = self::$exchangeRateMap[$currency = \strtoupper($currency)] ?? '';

        if (!$exchangeRateClassName || !\class_exists($exchangeRateClassName)) {
            throw new \InvalidArgumentException("ExchangeRate instance for `$currency` is not registered/existing");
        }

        return new $exchangeRateClassName(ExchangeRateClient::fetchRatesFromApi($currency)['rates']);
    }
}
