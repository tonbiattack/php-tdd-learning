<?php declare(strict_types=1);

namespace PhpTddLearning\Tests\Fundamentals;

use InvalidArgumentException;
use PhpTddLearning\Fundamentals\Greeting;
use PHPUnit\Framework\TestCase;

final class GreetingTest extends TestCase
{
    public function testJapaneseGreetingUsesProvidedName(): void
    {
        self::assertSame('こんにちは、花子！', Greeting::hello('花子'));
    }

    public function testJapaneseGreetingUsesDefaultRecipientForBlankName(): void
    {
        self::assertSame('こんにちは、世界！', Greeting::hello('   '));
    }

    public function testEnglishGreetingCanBeSelected(): void
    {
        self::assertSame('Hello, Ada!', Greeting::hello('Ada', 'en'));
    }

    public function testUnsupportedLanguageIsRejected(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported language: fr');

        Greeting::hello('Ada', 'fr');
    }
}
