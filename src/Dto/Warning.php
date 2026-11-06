<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;

class Warning
{
    /**
     * Warning code
     */
    #[Type('string')]
    public ?string $code = null;

    /**
     * Warning description
     */
    #[Type('string')]
    public ?string $message = null;
}