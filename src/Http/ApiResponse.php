<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Http;

use Psr\Http\Message\ResponseInterface;

final readonly class ApiResponse
{
    private string $body;

    /** @var array<int, array{code: string, message: string}> */
    private array $errors;

    private int $status;

    public function __construct(?ResponseInterface $response = null)
    {
        if ($response === null) {
            $this->status = 500;
            $this->body = '';
            $this->errors = [[
                'code' => 'internal_error',
                'message' => 'Internal Server Error',
            ]];

            return;
        }

        $this->status = $response->getStatusCode();
        $this->body = (string) $response->getBody();
        $this->errors = $this->status > 299 ? $this->parseErrors($this->body) : [];
    }

    public function isOk(): bool
    {
        return $this->status >= 200 && $this->status < 300;
    }

    public function hasErrors(): bool
    {
        return $this->errors !== [];
    }

    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return array<int, array{code: string, message: string}>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return array<int, array{code: string, message: string}>
     */
    private function parseErrors(string $body): array
    {
        $decoded = json_decode($body, true);

        if (!is_array($decoded)) {
            return [];
        }

        if (isset($decoded['error'])) {
            return [[
                'code' => (string) $decoded['error'],
                'message' => (string) ($decoded['error_description'] ?? $decoded['message'] ?? 'unknown_error'),
            ]];
        }

        if (isset($decoded['errors']) && is_array($decoded['errors'])) {
            return array_map(
                static fn (array $e): array => [
                    'code' => (string) ($e['code'] ?? ''),
                    'message' => (string) ($e['message'] ?? ''),
                ],
                $decoded['errors']
            );
        }

        return [];
    }
}