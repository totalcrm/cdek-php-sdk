<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Actions;

use TotalCRM\Cdek\BaseTypes\Invoice;
use TotalCRM\Cdek\Exceptions\RequestException;
use TotalCRM\Cdek\Http\ApiResponse;

final class Invoices extends Action
{
    public const string URL = '/print/orders';

    /**
     * @throws RequestException
     */
    public function add(Invoice $invoice): ApiResponse
    {
        return $this->preparedAddObject($invoice);
    }

    /**
     * @throws RequestException
     */
    public function download(string $uuid): ApiResponse
    {
        return $this->httpClient->get($this->slug($uuid) . '.pdf');
    }
}