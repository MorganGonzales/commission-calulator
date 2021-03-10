<?php

declare(strict_types=1);

namespace Morgy\CommissionTask\Domain;

class Operation
{
    private string $date;

    private int $userId;

    private string $userType;

    private string $type;

    private string $amount;

    private string $currency;

    private function __construct(array $data)
    {
        list($this->date, $this->userId, $this->userType, $this->type, $this->amount, $this->currency) = $data;
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

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}
