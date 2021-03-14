<?php

declare(strict_types=1);

namespace Morgy\CommissionTask\Domain\Exchange;

class ExchangeRateClient
{
    /**
     * Register exchange currency API endpoints here.
     *
     * This assumes that exchange rates can be fetch from different API URLs
     * (but can be simplified)
     */
    private static array $urlMap = [
        'EUR' => 'https://api.exchangeratesapi.io/latest',
        'USD' => 'https://api.exchangeratesapi.io/latest?base=USD',
        'JPY' => 'https://api.exchangeratesapi.io/latest?base=JPY',
    ];

    /**
     * This method should ideally create a client request (ex Curl or Guzzle) to the exchange rate API.
     * For the sake of this exam, I just simply used `file_get_contents` which doesn't happen in real-life scenario.
     */
    public static function fetchRatesFromApi(string $currency): array
    {
        $url = self::$urlMap[$currency] ?? '';

        if (!$url) {
            throw new \InvalidArgumentException('Exchange Rate API is not registered.');
        }

        return \json_decode(file_get_contents($url), true);
    }
}
