<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Actions;

use TotalCRM\Cdek\BaseTypes\Barcode;
use TotalCRM\Cdek\Exceptions\RequestException;
use TotalCRM\Cdek\Http\ApiResponse;

final class Barcodes extends Action
{
    public const string URL = '/print/barcodes';

    /**
     * @throws RequestException
     */
    public function add(Barcode $barcode): ApiResponse
    {
        return $this->preparedAddObject($barcode);
    }

    /**
     * @throws RequestException
     */
    public function download(string $uuid): ApiResponse
    {
        return $this->httpClient->get($this->slug($uuid) . '.pdf');
    }
}