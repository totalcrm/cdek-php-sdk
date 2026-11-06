<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;
use TotalCRM\Cdek\BaseTypes\Services;

class Tariff
{
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

    /**
     * Calculated weight (in grams)
     */
    #[Type('int')]
    public ?int $weight_calc = null;

    /**
     * Additional services
     *
     * @var Services[]
     */
    #[Type('array<TotalCRM\Cdek\BaseTypes\Services>')]
    public ?array $services = null;

    /**
     * Delivery cost including additional services
     */
    #[Type('float')]
    public ?float $total_sum = null;

    /**
     * Currency in which the delivery cost is calculated (CDEK code)
     */
    #[Type('string')]
    public ?string $currency = null;

    /**
     * List of errors
     *
     * @var Error[]
     */
    #[Type('array<TotalCRM\Cdek\Dto\Error>')]
    public ?array $errors = null;
}