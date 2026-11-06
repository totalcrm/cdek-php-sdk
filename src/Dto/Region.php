<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;

class Region
{
    /**
     * Region name
     */
    #[Type('string')]
    public ?string $region = null;

    /**
     * CDEK region code
     */
    #[Type('int')]
    public ?int $region_code = null;

    /**
     * Region FIAS unique identifier
     */
    #[Type('string')]
    public ?string $fias_region_guid = null;

    /**
     * Region KLADR code
     */
    #[Type('string')]
    public ?string $kladr_region_code = null;

    /**
     * Region country name
     */
    #[Type('string')]
    public ?string $country = null;

    /**
     * Country code in ISO 3166-1 alpha-2 format
     *
     * @example RU, DE, TR
     */
    #[Type('string')]
    public ?string $country_code = null;
}