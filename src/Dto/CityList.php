<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;

class CityList
{
    /**
     * List of cities
     *
     * @var City[]
     */
    #[Type('array<TotalCRM\Cdek\Dto\City>')]
    public ?array $items = null;
}