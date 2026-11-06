<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;

class PickupImage
{
    /**
     * Photo URL
     */
    #[Type('string')]
    public ?string $url = null;

    /**
     * Photo number
     */
    #[Type('int')]
    public ?int $number = null;
}