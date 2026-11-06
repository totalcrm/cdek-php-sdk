<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;

class ResponseStatus
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
     * Status set date and time
     */
    #[Type('string')]
    public ?string $date_time = null;
}