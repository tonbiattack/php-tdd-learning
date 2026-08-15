<?php declare(strict_types=1);

namespace PhpTddLearning\Fundamentals;

final class NumberList
{
    /**
     * @param list<int|float> $numbers
     */
    public static function sum(array $numbers): int|float
    {
        return array_sum($numbers);
    }

    /**
     * @param list<int|float> $numbers
     * @return list<int|float>
     */
    public static function sumsByPrefix(array $numbers): array
    {
        $sums = [];
        $runningTotal = 0;

        foreach ($numbers as $number) {
            $runningTotal += $number;
            $sums[] = $runningTotal;
        }

        return $sums;
    }
}
