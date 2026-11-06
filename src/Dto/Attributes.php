<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;

class Attributes
{
    /**
     * Return order flag
     */
    #[Type('bool')]
    public ?bool $is_return = null;

    /**
     * CDEK order number
     */
    #[Type('int')]
    public ?int $cdek_number = null;

    /**
     * Order number in the client IS
     */
    #[Type('string')]
    public ?string $number = null;

    /**
     * Status code
     */
    #[Type('string')]
    public ?string $status_code = null;

    /**
     * Additional status code
     */
    #[Type('string')]
    public ?string $status_reason_code = null;

    /**
     * Status set date and time
     */
    #[Type('string')]
    public ?string $status_date_time = null;

    /**
     * Name of the city (location) where the status changed
     */
    #[Type('string')]
    public ?string $city = null;

    /**
     * Print form type
     */
    #[Type('string')]
    public ?string $type = null;

    /**
     * File download link
     */
    #[Type('string')]
    public ?string $url = null;
}