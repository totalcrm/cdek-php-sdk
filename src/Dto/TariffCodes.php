<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation as Serializer;

class TariffCodes
{
    /**
     * Available tariffs
     *
     * @var TariffShort[]
     */
    #[Serializer\Type('array<TotalCRM\Cdek\Dto\TariffShort>')]
    public ?array $tariff_codes = null;
}