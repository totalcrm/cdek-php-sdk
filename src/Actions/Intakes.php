<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Actions;

use TotalCRM\Cdek\BaseTypes\Intake;
use TotalCRM\Cdek\Exceptions\RequestException;
use TotalCRM\Cdek\Http\ApiResponse;

final class Intakes extends ActionsWithDelete
{
    public const string URL = '/intakes';

    /**
     * @throws RequestException
     */
    public function add(Intake $intake): ApiResponse
    {
        return $this->preparedAddObject($intake);
    }
}