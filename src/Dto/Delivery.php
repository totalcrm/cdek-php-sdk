<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\SkipWhenEmpty;
use JMS\Serializer\Annotation\Type;
use TotalCRM\Cdek\BaseTypes\Location;

class Delivery
{
    /**
     * Delivery date agreement identifier in Pintex
     */
    #[Type('string')]
    public ?string $uuid = null;

    /**
     * CDEK order number
     */
    #[Type('int')]
    public ?int $cdek_number = null;

    /**
     * Order identifier in the CDEK IS
     */
    #[Type('string')]
    public ?string $order_uuid = null;

    /**
     * Delivery date agreed with the recipient
     */
    #[Type('string')]
    public ?string $date = null;

    /**
     * Courier waiting start time (agreed with the recipient)
     */
    #[Type('string')]
    public ?string $time_from = null;

    /**
     * Courier waiting end time (agreed with the recipient)
     */
    #[Type('string')]
    public ?string $time_to = null;

    /**
     * Comment
     */
    #[Type('string')]
    public ?string $comment = null;

    /**
     * New CDEK pickup point code where the parcel will be delivered (if a change was requested)
     */
    #[SkipWhenEmpty]
    #[Type('string')]
    public ?string $delivery_point = null;

    /**
     * New delivery address (if a change was requested)
     */
    #[Type('TotalCRM\Cdek\BaseTypes\Location')]
    public ?Location $to_location = null;

    /**
     * Delivery agreement statuses
     *
     * @var Statuses[]
     */
    #[Type('array<TotalCRM\Cdek\Dto\Statuses>')]
    public ?array $statuses = null;
}