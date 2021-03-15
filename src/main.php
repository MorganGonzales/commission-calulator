<?php

declare(strict_types=1);

use Morgy\CommissionTask\Domain\Commission\DepositCommission;
use Morgy\CommissionTask\Domain\Commission\WithdrawCommision;
use Morgy\CommissionTask\Domain\Exchange\ExchangeRateFactory;
use Morgy\CommissionTask\Domain\Operations;
use Morgy\CommissionTask\Service\ListCommissionPerOperation;

function main($argv)
{
    // Read the CSV contents and convert them as an array
    if ($argv[1] ?? false) {
        $csv = \array_map('str_getcsv', file($argv[1]));
    }

    // Each item in the CSV array will be represented by a value object called `Operation`
    // and will be stored in this Aggregate `Operations`
    $operations = Operations::fromArray($csv);

    // The service that orchestrates the calculation of commission fees for each `Operation`
    $service = new ListCommissionPerOperation(
        new WithdrawCommision(ExchangeRateFactory::create('EUR')),
        new DepositCommission()
    );

    displayOutput(...$service->execute(...$operations->toArray()));
}

function displayOutput(string ...$items)
{
    foreach ($items as $item) {
        echo $item.PHP_EOL;
    }
}
