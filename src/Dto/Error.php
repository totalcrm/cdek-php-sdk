<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;

class Error
{
    /**
     * Error code
     */
    #[Type('string')]
    public ?string $code = null;

    /**
     * Error description
     */
    #[Type('string')]
    public ?string $message = null;
}