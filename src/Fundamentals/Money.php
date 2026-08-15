<?php declare(strict_types=1);

namespace PhpTddLearning\Fundamentals;

final readonly class Money
{
    public function __construct(public int $yen)
    {
        if ($yen < 0) {
            throw new \InvalidArgumentException('Money must not be negative.');
        }
    }

    public function add(self $other): self
    {
        return new self($this->yen + $other->yen);
    }

    public function isLessThan(self $other): bool
    {
        return $this->yen < $other->yen;
    }

    public function subtract(self $other): self
    {
        if ($this->isLessThan($other)) {
            throw new \LogicException('Cannot subtract a larger amount.');
        }

        return new self($this->yen - $other->yen);
    }
}
