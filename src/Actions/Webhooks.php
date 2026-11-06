<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Actions;

use JMS\Serializer\Exception\RuntimeException as SerializerRuntimeException;
use JsonException;
use TotalCRM\Cdek\BaseTypes\WebHook;
use TotalCRM\Cdek\Dto\InputHook;
use TotalCRM\Cdek\Exceptions\RequestException;
use TotalCRM\Cdek\Http\ApiResponse;

final class Webhooks extends ActionsWithDelete
{
    public const string URL = '/webhooks';

    /**
     * @throws RequestException
     */
    public function add(WebHook $webHook): ApiResponse
    {
        return $this->preparedAddObject($webHook);
    }

    /**
     * @throws RequestException
     */
    public function list(): ApiResponse
    {
        return $this->httpClient->get(static::URL);
    }

    public function parse(string $string): InputHook
    {
        try {
            return $this->serializer->deserialize($string, InputHook::class, 'json');
        } catch (SerializerRuntimeException|JsonException) {
            return new InputHook();
        }
    }
}