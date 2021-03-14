<?php

declare(strict_types=1);

namespace Morgy\CommissionTask\Domain;

class Operations implements \IteratorAggregate, \Countable
{
    /**
     * @var Operation[]
     */
    private array $operations = [];

    public function __construct(Operation ...$operations)
    {
        $this->operations = $operations;
    }

    public static function fromArray(array $data): self
    {
        $operations = \array_map(function (array $operationData) {
            return Operation::fromArray($operationData);
        }, $data);

        return new self(...$operations);
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->operations);
    }

    public function count(): int
    {
        return \count($this->operations);
    }

    public function toArray(): array
    {
        return $this->operations;
    }
}
