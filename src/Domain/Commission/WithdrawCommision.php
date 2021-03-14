<?php

declare(strict_types=1);

namespace Morgy\CommissionTask\Domain\Commission;

use Morgy\CommissionTask\Domain\Exchange\ExchangeRate;
use Morgy\CommissionTask\Domain\Operation;

class WithdrawCommision extends Commission
{
    private const MAX_FREE_AMOUNT_IN_A_WEEK = 1000;

    private const PRIVATE_COMMISSION_PERCENTAGE = 0.3;

    private const BUSINESS_COMMISSION_PERCENTAGE = 0.5;

    /**
     * This mimics any form of persistence layer where historical transactions are stored.
     */
    private static array $transactionData = [];

    private ExchangeRate $exchangeRate;

    public function __construct(ExchangeRate $exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;
    }

    public function calculate(Operation $operation): string
    {
        return $operation->getUserType() === 'private'
            ? self::computeForPrivateUser($operation)
            : self::computeForBusinessUser($operation);
    }

    private function computeForPrivateUser(Operation $operation): string
    {
        $chargeableAmount = self::getChargeableAmount($operation);
        $commissionInBaseCurrency = (self::PRIVATE_COMMISSION_PERCENTAGE / 100) * $chargeableAmount;

        return $this->roundUp(
            $this->exchangeRate->revert((string) $commissionInBaseCurrency, $operation->getCurrency()),
            $this->countDecimals($operation->getAmount())
        );
    }

    private function computeForBusinessUser(Operation $operation): string
    {
        return $this->roundUp(
            (string) ((self::BUSINESS_COMMISSION_PERCENTAGE / 100) * $operation->getAmount()),
            $this->countDecimals($operation->getAmount())
        );
    }

    private function getChargeableAmount(Operation $operation): float
    {
        $chargeableAmount = 0;
        $transactionId = \date('oW', \strtotime($operation->getDate())).$operation->getUserId();
        $previousTransaction = self::$transactionData[$transactionId] ?? 0;

        self::$transactionData[$transactionId] =
            $previousTransaction + $this->exchangeRate->convert($operation->getAmount(), $operation->getCurrency());

        if (self::$transactionData[$transactionId] > self::MAX_FREE_AMOUNT_IN_A_WEEK) {
            $chargeableAmount = self::$transactionData[$transactionId] - self::MAX_FREE_AMOUNT_IN_A_WEEK;
            self::$transactionData[$transactionId] = self::MAX_FREE_AMOUNT_IN_A_WEEK;
        }

        return $chargeableAmount;
    }
}
