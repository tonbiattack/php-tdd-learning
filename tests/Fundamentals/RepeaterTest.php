<?php declare(strict_types=1);

namespace PhpTddLearning\Tests\Fundamentals;

use InvalidArgumentException;
use PhpTddLearning\Fundamentals\Repeater;
use PHPUnit\Framework\TestCase;

final class RepeaterTest extends TestCase
{
    public function testRepeatsAStringSpecifiedNumberOfTimes(): void
    {
        self::assertSame('Go!Go!Go!', Repeater::repeat('Go!', 3));
    }

    public function testRepeatingZeroTimesReturnsAnEmptyString(): void
    {
        self::assertSame('', Repeater::repeat('Go!', 0));
    }

    public function testNegativeRepeatCountIsRejected(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Repeater::repeat('Go!', -1);
    }
}
