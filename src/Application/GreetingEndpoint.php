<?php declare(strict_types=1);

namespace PhpTddLearning\Application;

use PhpTddLearning\Fundamentals\Greeting;

final class GreetingEndpoint
{
    /**
     * @param array<string, mixed> $query
     * @return array{status: int, headers: array<string, string>, body: string}
     */
    public function handle(array $query): array
    {
        try {
            $name = $query['name'] ?? null;
            $language = $query['lang'] ?? 'ja';

            if (!is_null($name) && !is_string($name)) {
                throw new \InvalidArgumentException('name must be a string.');
            }

            if (!is_string($language)) {
                throw new \InvalidArgumentException('lang must be a string.');
            }

            return $this->response(200, ['message' => Greeting::hello($name, $language)]);
        } catch (\InvalidArgumentException $exception) {
            return $this->response(400, ['error' => $exception->getMessage()]);
        }
    }

    /**
     * @param array<string, string> $payload
     * @return array{status: int, headers: array<string, string>, body: string}
     */
    private function response(int $status, array $payload): array
    {
        return [
            'status' => $status,
            'headers' => ['Content-Type' => 'application/json; charset=utf-8'],
            'body' => json_encode($payload, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE),
        ];
    }
}
