<?php

declare(strict_types=1);

use Morgy\CommissionTask\Domain\Commission\DepositCommission;
use Morgy\CommissionTask\Domain\Commission\WithdrawCommision;
use Morgy\CommissionTask\Domain\Exchange\ExchangeRateFactory;
use Morgy\CommissionTask\Domain\Operations;
use Morgy\CommissionTask\Service\ListCommissionPerOperation;

function main($argv)
{
    if ($argv[1] ?? false) {
        $csv = \array_map('str_getcsv', file($argv[1]));
    }

    $operations = Operations::fromArray($csv);
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
