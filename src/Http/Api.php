<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Http;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use TotalCRM\Cdek\Constants;
use TotalCRM\Cdek\Exceptions\AuthException;
use TotalCRM\Cdek\Exceptions\RequestException;

class Api
{
    private string $account;
    private string $secure;
    private bool $test = false;
    private string $token = '';
    private int $expire = 0;

    private ?string $originalAccount = null;
    private ?string $originalSecure = null;

    protected ClientInterface $client;

    public function __construct(ClientInterface $http, ?string $account = null, ?string $secure = null)
    {
        $this->account = $account ?? '';
        $this->secure = $secure ?? '';
        $this->client = $http;
    }

    public function getAccount(): string
    {
        return $this->account;
    }

    public function setAccount(string $account): void
    {
        $this->account = $account;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getSecure(): string
    {
        return $this->secure;
    }

    public function setSecure(string $secure): void
    {
        $this->secure = $secure;
    }

    public function isTest(): bool
    {
        return $this->test;
    }

    public function setTest(bool $test): void
    {
        if ($test && !$this->test) {
            $this->originalAccount = $this->account;
            $this->originalSecure = $this->secure;
            $this->account = Constants::TEST_ACCOUNT;
            $this->secure = Constants::TEST_SECURE;
        } elseif (!$test && $this->test) {
            $this->account = $this->originalAccount ?? '';
            $this->secure = $this->originalSecure ?? '';
        }

        if ($test !== $this->test) {
            $this->token = '';
            $this->expire = 0;
        }

        $this->test = $test;
    }

    /**
     * @throws AuthException
     * @throws RequestException
     */
    public function authorize(): bool
    {
        $response = $this->post('/oauth/token', [
            Constants::AUTH_KEY_TYPE => Constants::AUTH_PARAM_CREDENTIAL,
            Constants::AUTH_KEY_CLIENT_ID => $this->account,
            Constants::AUTH_KEY_SECRET => $this->secure,
        ]);

        if (!$response->isOk()) {
            $this->token = '';
            $this->expire = 0;

            throw new AuthException(Constants::AUTH_FAIL);
        }

        $tokenInfo = $this->decodeBody($response->getBody());
        $this->token = (string) ($tokenInfo['access_token'] ?? '');
        $this->expire = time() + max(0, (int) ($tokenInfo['expires_in'] ?? 0) - 10);

        return true;
    }

    public function isExpired(): bool
    {
        return $this->expire < time();
    }

    public function getExpire(): int
    {
        return $this->expire;
    }

    public function setExpire(int $timestamp): void
    {
        $this->expire = $timestamp;
    }

    /**
     * @throws AuthException
     * @throws RequestException
     */
    public function post(string $url, array $params = []): ApiResponse
    {
        return $this->request('POST', $url, $params);
    }

    /**
     * @throws AuthException
     * @throws RequestException
     */
    public function patch(string $url, array $params = []): ApiResponse
    {
        return $this->request('PATCH', $url, $params);
    }

    /**
     * @throws AuthException
     * @throws RequestException
     */
    public function get(string $url): ApiResponse
    {
        return $this->request('GET', $url);
    }

    /**
     * @throws AuthException
     * @throws RequestException
     */
    public function delete(string $url): ApiResponse
    {
        return $this->request('DELETE', $url);
    }

    /**
     * @throws AuthException
     * @throws RequestException
     */
    protected function request(string $method, string $url, array $params = []): ApiResponse
    {
        $isOauth = $url === '/oauth/token';
        $url = ($this->test ? Constants::API_URL_TEST : Constants::API_URL) . $url;
        $uri = new Uri($url);

        try {
            $headers = [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'User-Agent' => 'TotalCRM-CDEK-SDK/1.0',
            ];

            if ($isOauth) {
                $headers['Content-Type'] = 'application/x-www-form-urlencoded';
            } elseif ($this->isExpired()) {
                $this->authorize();
            }

            $body = $isOauth
                ? http_build_query($params)
                : json_encode($params, JSON_THROW_ON_ERROR);

            if ($this->token !== '') {
                $headers['Authorization'] = 'Bearer ' . $this->token;
            }

            $response = $this->client->sendRequest(new Request($method, $uri, $headers, $body));

            return new ApiResponse($response);
        } catch (ClientExceptionInterface|JsonException $e) {
            throw new RequestException($e->getMessage(), (int) $e->getCode());
        }
    }

    private function decodeBody(string $body): array
    {
        $decoded = json_decode($body, true);

        return is_array($decoded) ? $decoded : [];
    }
}