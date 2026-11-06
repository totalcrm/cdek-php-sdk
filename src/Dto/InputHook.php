<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;

class InputHook
{
    /**
     * Event type
     */
    #[Type('string')]
    public ?string $type = null;

    /**
     * Event date and time in UTC
     */
    #[Type('string')]
    public ?string $date_time = null;

    /**
     * Order identifier
     */
    #[Type('string')]
    public ?string $uuid = null;

    /**
     * Event attributes
     */
    #[Type('TotalCRM\Cdek\Dto\Attributes')]
    public ?Attributes $attributes = null;
}