<?php declare(strict_types=1);

namespace PhpTddLearning\Fundamentals;

final class Greeting
{
    public static function hello(?string $name = null, string $language = 'ja'): string
    {
        $recipient = trim((string) $name);
        $recipient = $recipient === '' ? '世界' : $recipient;

        return match ($language) {
            'ja' => "こんにちは、{$recipient}！",
            'en' => "Hello, {$recipient}!",
            default => throw new \InvalidArgumentException("Unsupported language: {$language}"),
        };
    }
}
