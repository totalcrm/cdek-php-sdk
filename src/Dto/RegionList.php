<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;

class RegionList
{
    /**
     * List of regions
     *
     * @var Region[]
     */
    #[Type('array<TotalCRM\Cdek\Dto\Region>')]
    public ?array $items = null;
}