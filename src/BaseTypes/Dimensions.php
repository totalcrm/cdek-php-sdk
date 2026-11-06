<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\BaseTypes;

use JMS\Serializer\Annotation\Type;

class Dimensions
{
    /**
     * Width (cm)
     */
    #[Type('float')]
    public ?float $width = null;

    /**
     * Height (cm)
     */
    #[Type('float')]
    public ?float $height = null;

    /**
     * Depth (cm)
     */
    #[Type('float')]
    public ?float $depth = null;
}