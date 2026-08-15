<?php declare(strict_types=1);

namespace PhpTddLearning\Application;

interface Writer
{
    public function write(string $message): void;
}
