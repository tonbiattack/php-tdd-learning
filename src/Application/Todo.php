<?php declare(strict_types=1);

namespace PhpTddLearning\Application;

final readonly class Todo
{
    public function __construct(public string $title, public bool $done = false)
    {
        if (trim($title) === '') {
            throw new \InvalidArgumentException('Todo title must not be empty.');
        }
    }

    /**
     * @return array{title: string, done: bool}
     */
    public function toArray(): array
    {
        return ['title' => $this->title, 'done' => $this->done];
    }

    /**
     * @param array{title?: mixed, done?: mixed} $data
     */
    public static function fromArray(array $data): self
    {
        if (!isset($data['title']) || !is_string($data['title'])) {
            throw new \UnexpectedValueException('Todo data requires a string title.');
        }

        if (isset($data['done']) && !is_bool($data['done'])) {
            throw new \UnexpectedValueException('Todo done flag must be boolean.');
        }

        return new self($data['title'], $data['done'] ?? false);
    }
}
