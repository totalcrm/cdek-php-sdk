<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\BaseTypes;

use JMS\Serializer\Annotation\Type;
use TotalCRM\Cdek\Dto\ResponseStatus;

class Barcode extends Base
{
    /**
     * Print request identifier
     */
    #[Type('string')]
    public ?string $uuid = null;

    /**
     * List of orders
     *
     * @var OrdersList[]
     */
    #[Type('array<TotalCRM\Cdek\BaseTypes\OrdersList>')]
    public ?array $orders = null;

    /**
     * Number of copies. Defaults to 1
     */
    #[Type('int')]
    public int $copy_count = 1;

    /**
     * Print format. Allowed values: A4, A5, A6. Defaults to A4
     */
    #[Type('string')]
    public string $format = 'A4';

    /**
     * File download link
     */
    #[Type('string')]
    public ?string $url = null;

    /**
     * List of request statuses
     *
     * @var ResponseStatus[]
     */
    #[Type('array<TotalCRM\Cdek\Dto\ResponseStatus>')]
    public ?array $statuses = null;
}