<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Actions;

use TotalCRM\Cdek\BaseTypes\TariffList;
use TotalCRM\Cdek\Exceptions\RequestException;
use TotalCRM\Cdek\Http\ApiResponse;

final class CalculatorTariffList extends Action
{
    public const string URL = '/calculator/tarifflist';

    /**
     * @throws RequestException
     */
    public function calculate(TariffList $tariffList): ApiResponse
    {
        return $this->preparedAddObject($tariffList);
    }
}