<?php declare(strict_types=1);

namespace PhpTddLearning\Tests\Application;

use PhpTddLearning\Application\GreetingEndpoint;
use PHPUnit\Framework\TestCase;

final class GreetingEndpointTest extends TestCase
{
    public function testReturnsJapaneseGreetingAsJson(): void
    {
        $response = (new GreetingEndpoint())->handle(['name' => '花子']);

        self::assertSame(200, $response['status']);
        self::assertSame('application/json; charset=utf-8', $response['headers']['Content-Type']);
        self::assertSame(['message' => 'こんにちは、花子！'], json_decode($response['body'], true, flags: JSON_THROW_ON_ERROR));
    }

    public function testReturnsEnglishGreetingAsJson(): void
    {
        $response = (new GreetingEndpoint())->handle(['name' => 'Ada', 'lang' => 'en']);

        self::assertSame(200, $response['status']);
        self::assertSame(['message' => 'Hello, Ada!'], json_decode($response['body'], true, flags: JSON_THROW_ON_ERROR));
    }

    public function testReturnsBadRequestForUnsupportedLanguage(): void
    {
        $response = (new GreetingEndpoint())->handle(['name' => 'Ada', 'lang' => 'fr']);

        self::assertSame(400, $response['status']);
        self::assertSame(['error' => 'Unsupported language: fr'], json_decode($response['body'], true, flags: JSON_THROW_ON_ERROR));
    }

    public function testReturnsBadRequestForNonStringName(): void
    {
        $response = (new GreetingEndpoint())->handle(['name' => ['Ada']]);

        self::assertSame(400, $response['status']);
        self::assertSame(['error' => 'name must be a string.'], json_decode($response['body'], true, flags: JSON_THROW_ON_ERROR));
    }
}
