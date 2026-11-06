<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Actions;

use TotalCRM\Cdek\BaseTypes\Order;
use TotalCRM\Cdek\Exceptions\RequestException;
use TotalCRM\Cdek\Http\ApiResponse;

final class Orders extends ActionsWithDelete
{
    public const string URL = '/orders';

    /**
     * @throws RequestException
     */
    public function add(Order $order): ApiResponse
    {
        return $this->preparedAddObject($order);
    }

    /**
     * @throws RequestException
     */
    public function edit(Order $order): ApiResponse
    {
        return $this->preparedEdit($this->serializer->toArray($order));
    }

    /**
     * @throws RequestException
     */
    public function getByNumber(string $number): ApiResponse
    {
        return $this->httpClient->get(static::URL . '?cdek_number=' . rawurlencode($number));
    }
}