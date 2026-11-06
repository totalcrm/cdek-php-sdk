<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Actions;

use TotalCRM\Cdek\Exceptions\RequestException;
use TotalCRM\Cdek\Http\ApiResponse;

abstract class ActionsWithDelete extends Action
{
    /**
     * @throws RequestException
     */
    public function delete(string $uuid): ApiResponse
    {
        return $this->httpClient->delete($this->slug($uuid));
    }
}