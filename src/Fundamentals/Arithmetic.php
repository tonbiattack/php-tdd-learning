<?php declare(strict_types=1);

namespace PhpTddLearning\Fundamentals;

final class Arithmetic
{
    public static function add(int|float $left, int|float $right): int|float
    {
        return $left + $right;
    }

    public static function subtract(int|float $left, int|float $right): int|float
    {
        return $left - $right;
    }
}
