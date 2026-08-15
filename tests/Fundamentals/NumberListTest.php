<?php declare(strict_types=1);

namespace PhpTddLearning\Tests\Fundamentals;

use PhpTddLearning\Fundamentals\NumberList;
use PHPUnit\Framework\TestCase;

final class NumberListTest extends TestCase
{
    public function testSumsEveryNumberInTheList(): void
    {
        self::assertSame(10, NumberList::sum([1, 2, 3, 4]));
    }

    public function testSumOfAnEmptyListIsZero(): void
    {
        self::assertSame(0, NumberList::sum([]));
    }

    public function testReturnsRunningSums(): void
    {
        self::assertSame([1, 3, 6, 10], NumberList::sumsByPrefix([1, 2, 3, 4]));
    }

    public function testRunningSumsForAnEmptyListAreEmpty(): void
    {
        self::assertSame([], NumberList::sumsByPrefix([]));
    }
}
