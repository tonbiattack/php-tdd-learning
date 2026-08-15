<?php declare(strict_types=1);

namespace PhpTddLearning\Application;

final readonly class JsonTodoStore
{
    public function __construct(private string $path)
    {
    }

    /**
     * @param list<Todo> $todos
     */
    public function save(array $todos): void
    {
        $payload = array_map(static fn (Todo $todo): array => $todo->toArray(), $todos);
        $json = json_encode($payload, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        if (file_put_contents($this->path, $json) === false) {
            throw new \RuntimeException("Could not write todo store: {$this->path}");
        }
    }

    /**
     * @return list<Todo>
     */
    public function load(): array
    {
        if (!file_exists($this->path)) {
            return [];
        }

        $json = file_get_contents($this->path);
        if ($json === false) {
            throw new \RuntimeException("Could not read todo store: {$this->path}");
        }

        try {
            $decoded = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $exception) {
            throw new \UnexpectedValueException('Todo store contains invalid JSON.', previous: $exception);
        }

        if (!is_array($decoded) || !array_is_list($decoded)) {
            throw new \UnexpectedValueException('Todo store must contain a JSON array.');
        }

        return array_map(
            static function (mixed $item): Todo {
                if (!is_array($item)) {
                    throw new \UnexpectedValueException('Every todo entry must be an object.');
                }

                return Todo::fromArray($item);
            },
            $decoded,
        );
    }
}
