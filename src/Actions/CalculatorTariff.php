<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Actions;

use TotalCRM\Cdek\BaseTypes\Tariff;
use TotalCRM\Cdek\Exceptions\RequestException;
use TotalCRM\Cdek\Http\ApiResponse;

final class CalculatorTariff extends Action
{
    public const string URL = '/calculator/tariff';

    /**
     * @throws RequestException
     */
    public function calculate(Tariff $tariff): ApiResponse
    {
        return $this->preparedAddObject($tariff);
    }
}