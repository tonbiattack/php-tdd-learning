<?php declare(strict_types=1);

namespace PhpTddLearning\Tests\Fundamentals;

use PhpTddLearning\Fundamentals\Arithmetic;
use PHPUnit\Framework\TestCase;

final class ArithmeticTest extends TestCase
{
    public function testAddsPositiveIntegers(): void
    {
        self::assertSame(5, Arithmetic::add(2, 3));
    }

    public function testAddsZeroAndNegativeNumbers(): void
    {
        self::assertSame(-3, Arithmetic::add(-3, 0));
    }

    public function testPreservesFloatResult(): void
    {
        self::assertSame(2.5, Arithmetic::add(1.0, 1.5));
    }

    public function testSubtractsNumbers(): void
    {
        self::assertSame(-2, Arithmetic::subtract(3, 5));
    }
}
