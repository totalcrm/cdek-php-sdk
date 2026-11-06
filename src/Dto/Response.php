<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation as Serializer;
use TotalCRM\Cdek\BaseTypes\Barcode;
use TotalCRM\Cdek\BaseTypes\Intake;
use TotalCRM\Cdek\BaseTypes\Invoice;
use TotalCRM\Cdek\BaseTypes\Order;
use TotalCRM\Cdek\BaseTypes\WebHook;

class Response
{
    /**
     * @var Barcode|Intake|Invoice|Order|WebHook|OrderInfo|Tariff|null
     */
    #[Serializer\Exclude]
    public Barcode|Intake|Invoice|Order|WebHook|OrderInfo|Tariff|null $entity = null;

    /**
     * @var Request[]
     */
    #[Serializer\Type('array<TotalCRM\Cdek\Dto\Request>')]
    public ?array $requests = null;

    /**
     * @var Relations[]
     */
    #[Serializer\Type('array<TotalCRM\Cdek\Dto\Relations>')]
    public ?array $related_entities = null;
}