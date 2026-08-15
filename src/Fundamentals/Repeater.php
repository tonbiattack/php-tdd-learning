<?php declare(strict_types=1);

namespace PhpTddLearning\Fundamentals;

final class Repeater
{
    public static function repeat(string $value, int $count): string
    {
        if ($count < 0) {
            throw new \InvalidArgumentException('Repeat count must not be negative.');
        }

        return str_repeat($value, $count);
    }
}
