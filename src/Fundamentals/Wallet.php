<?php declare(strict_types=1);

namespace PhpTddLearning\Fundamentals;

final class Wallet
{
    private Money $balance;

    public function __construct(?Money $initialBalance = null)
    {
        $this->balance = $initialBalance ?? new Money(0);
    }

    public function balance(): Money
    {
        return $this->balance;
    }

    public function deposit(Money $amount): void
    {
        $this->balance = $this->balance->add($amount);
    }

    public function withdraw(Money $amount): void
    {
        if ($this->balance->isLessThan($amount)) {
            throw new InsufficientFunds('Balance is insufficient for this withdrawal.');
        }

        $this->balance = $this->balance->subtract($amount);
    }
}
