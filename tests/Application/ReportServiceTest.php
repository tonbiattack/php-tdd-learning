<?php declare(strict_types=1);

namespace PhpTddLearning\Tests\Application;

use InvalidArgumentException;
use PhpTddLearning\Application\ReportService;
use PhpTddLearning\Application\Writer;
use PHPUnit\Framework\TestCase;

final class ReportServiceTest extends TestCase
{
    public function testPublishesFormattedReportThroughInjectedWriter(): void
    {
        $writer = new RecordingWriter();
        $service = new ReportService($writer);

        $service->publish('朝会', 3);

        self::assertSame(['朝会: 3件完了'], $writer->messages);
    }

    public function testEmptyTitleIsRejectedBeforeWriting(): void
    {
        $writer = new RecordingWriter();
        $service = new ReportService($writer);

        $this->expectException(InvalidArgumentException::class);
        $service->publish(' ', 3);
    }

    public function testNegativeCompletedTasksAreRejectedBeforeWriting(): void
    {
        $writer = new RecordingWriter();
        $service = new ReportService($writer);

        try {
            $service->publish('朝会', -1);
            self::fail('InvalidArgumentException should be thrown.');
        } catch (InvalidArgumentException) {
            self::assertSame([], $writer->messages);
        }
    }
}

final class RecordingWriter implements Writer
{
    /** @var list<string> */
    public array $messages = [];

    public function write(string $message): void
    {
        $this->messages[] = $message;
    }
}
