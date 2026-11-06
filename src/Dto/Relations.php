<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;

class Relations
{
    /**
     * Type of entity related to the order
     */
    #[Type('string')]
    public ?string $type = null;

    #[Type('string')]
    public ?string $uuid = null;
}