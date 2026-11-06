<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Actions;

use JMS\Serializer\Serializer;
use TotalCRM\Cdek\Exceptions\RequestException;
use TotalCRM\Cdek\Http\Api;
use TotalCRM\Cdek\Http\ApiResponse;

abstract class Action
{
    public const string URL = '';

    protected Api $httpClient;
    protected Serializer $serializer;

    public function __construct(Api $request, Serializer $serializer)
    {
        $this->httpClient = $request;
        $this->serializer = $serializer;
    }

    /**
     * @throws RequestException
     */
    public function get(string $uuid): ApiResponse
    {
        return $this->httpClient->get($this->slug($uuid));
    }

    /**
     * @throws RequestException
     */
    protected function preparedAdd(array $params = []): ApiResponse
    {
        return $this->httpClient->post($this->slug(), $params);
    }

    /**
     * @throws RequestException
     */
    protected function preparedAddObject(object $object): ApiResponse
    {
        return $this->preparedAdd($this->serializer->toArray($object));
    }

    /**
     * @throws RequestException
     */
    protected function preparedEdit(array $params = []): ApiResponse
    {
        return $this->httpClient->patch($this->slug(), $params);
    }

    protected function slug(?string $uuid = null): string
    {
        if (static::URL === '') {
            throw new \LogicException(sprintf('URL must be defined in %s', static::class));
        }

        return ($uuid === null || $uuid === '')
            ? static::URL
            : static::URL . '/' . $uuid;
    }
}