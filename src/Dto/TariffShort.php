<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;

class TariffShort
{
    /**
     * Tariff code
     */
    #[Type('int')]
    public ?int $tariff_code = null;

    /**
     * Tariff name in the output language
     */
    #[Type('string')]
    public ?string $tariff_name = null;

    /**
     * Tariff description in the output language
     */
    #[Type('string')]
    public ?string $tariff_description = null;

    /**
     * Delivery mode
     */
    #[Type('int')]
    public ?int $delivery_mode = null;

    /**
     * Delivery cost
     */
    #[Type('float')]
    public ?float $delivery_sum = null;

    /**
     * Minimum delivery time (in business days)
     */
    #[Type('int')]
    public ?int $period_min = null;

    /**
     * Maximum delivery time (in business days)
     */
    #[Type('int')]
    public ?int $period_max = null;
}