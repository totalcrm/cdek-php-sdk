<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;

class Statuses
{
    /**
     * Status code
     */
    #[Type('string')]
    public ?string $code = null;

    /**
     * Status name
     */
    #[Type('string')]
    public ?string $name = null;

    /**
     * Additional status code
     */
    #[Type('string')]
    public ?string $reason_code = null;

    /**
     * Status set date and time
     */
    #[Type('string')]
    public ?string $date_time = null;

    /**
     * Name of the city (location) where the status changed
     */
    #[Type('string')]
    public ?string $city = null;

    /**
     * Code of the locality where the status occurred
     */
    #[Type('int')]
    public ?int $city_code = null;
}