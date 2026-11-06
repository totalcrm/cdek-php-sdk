<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Actions;

use TotalCRM\Cdek\BaseTypes\Delivery;
use TotalCRM\Cdek\Exceptions\RequestException;
use TotalCRM\Cdek\Http\ApiResponse;

final class Deliveries extends Action
{
    public const string URL = '/delivery';

    /**
     * @throws RequestException
     */
    public function add(Delivery $delivery): ApiResponse
    {
        return $this->preparedAddObject($delivery);
    }
}