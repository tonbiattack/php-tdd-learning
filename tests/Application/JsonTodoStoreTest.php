<?php declare(strict_types=1);

namespace PhpTddLearning\Tests\Application;

use PhpTddLearning\Application\JsonTodoStore;
use PhpTddLearning\Application\Todo;
use PHPUnit\Framework\TestCase;

final class JsonTodoStoreTest extends TestCase
{
    private string $path;

    protected function setUp(): void
    {
        $this->path = tempnam(sys_get_temp_dir(), 'php-tdd-todos-');
        if ($this->path === false) {
            self::fail('Could not allocate a temporary file.');
        }
        unlink($this->path);
    }

    protected function tearDown(): void
    {
        if (file_exists($this->path)) {
            unlink($this->path);
        }
    }

    public function testMissingStoreLoadsAsAnEmptyList(): void
    {
        self::assertSame([], (new JsonTodoStore($this->path))->load());
    }

    public function testSavesAndLoadsTodos(): void
    {
        $store = new JsonTodoStore($this->path);
        $expected = [new Todo('テストを書く'), new Todo('リファクタリングする', true)];

        $store->save($expected);

        self::assertEquals($expected, $store->load());
        self::assertStringContainsString('テストを書く', (string) file_get_contents($this->path));
    }

    public function testInvalidJsonIsReportedAsDomainRelevantError(): void
    {
        file_put_contents($this->path, '{invalid json');

        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage('invalid JSON');

        (new JsonTodoStore($this->path))->load();
    }

    public function testTodoWithoutTitleIsRejected(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new Todo('  ');
    }
}
