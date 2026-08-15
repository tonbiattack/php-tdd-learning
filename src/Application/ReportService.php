<?php declare(strict_types=1);

namespace PhpTddLearning\Application;

final readonly class ReportService
{
    public function __construct(private Writer $writer)
    {
    }

    public function publish(string $title, int $completedTasks): void
    {
        if (trim($title) === '') {
            throw new \InvalidArgumentException('Report title must not be empty.');
        }

        if ($completedTasks < 0) {
            throw new \InvalidArgumentException('Completed task count must not be negative.');
        }

        $this->writer->write(sprintf('%s: %d件完了', $title, $completedTasks));
    }
}
