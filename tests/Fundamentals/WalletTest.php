<?php declare(strict_types=1);

namespace PhpTddLearning\Tests\Fundamentals;

use InvalidArgumentException;
use PhpTddLearning\Fundamentals\InsufficientFunds;
use PhpTddLearning\Fundamentals\Money;
use PhpTddLearning\Fundamentals\Wallet;
use PHPUnit\Framework\TestCase;

final class WalletTest extends TestCase
{
    public function testWalletStartsWithZeroYen(): void
    {
        self::assertSame(0, (new Wallet())->balance()->yen);
    }

    public function testDepositIncreasesBalance(): void
    {
        $wallet = new Wallet();

        $wallet->deposit(new Money(1_000));

        self::assertSame(1_000, $wallet->balance()->yen);
    }

    public function testWithdrawalDecreasesBalance(): void
    {
        $wallet = new Wallet(new Money(1_000));

        $wallet->withdraw(new Money(300));

        self::assertSame(700, $wallet->balance()->yen);
    }

    public function testWithdrawalOverBalanceRaisesExceptionAndKeepsBalance(): void
    {
        $wallet = new Wallet(new Money(500));

        try {
            $wallet->withdraw(new Money(501));
            self::fail('InsufficientFunds should be thrown.');
        } catch (InsufficientFunds) {
            self::assertSame(500, $wallet->balance()->yen);
        }
    }

    public function testNegativeMoneyIsRejected(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Money(-1);
    }
}
