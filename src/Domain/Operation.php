<?php

declare(strict_types=1);

namespace Morgy\CommissionTask\Domain;

class BaseOperation
{
    private string $date;

    private int $userId;

    private string $userType;

    private string $type;

    private float $amount;

    private string $currency;

    private function __construct(array $data)
    {
        $this->date = $data[0];
        $this->userId = (int) $data[1];
        $this->userType = $data[2];
        $this->type = $data[3];
        $this->amount = (float) $data[4];
        $this->currency = $data[5];
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getUserType(): string
    {
        return $this->userType;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}
