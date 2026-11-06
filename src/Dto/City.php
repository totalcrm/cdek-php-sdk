<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;

class City
{
    /**
     * Locality name
     */
    #[Type('string')]
    public ?string $city = null;

    /**
     * Locality code (CDEK reference)
     */
    #[Type('int')]
    public ?int $code = null;

    /**
     * Postal codes
     *
     * @var string[]
     */
    #[Type('array<string>')]
    public ?array $postal_codes = null;

    /**
     * Locality FIAS unique identifier
     */
    #[Type('string')]
    public ?string $fias_guid = null;

    /**
     * Locality KLADR code
     */
    #[Type('string')]
    public ?string $kladr_code = null;

    /**
     * Locality center longitude
     */
    #[Type('float')]
    public ?float $longitude = null;

    /**
     * Locality center latitude
     */
    #[Type('float')]
    public ?float $latitude = null;

    /**
     * Region sub-district name
     */
    #[Type('string')]
    public ?string $sub_region = null;

    /**
     * Region name
     */
    #[Type('string')]
    public ?string $region = null;

    /**
     * Locality region code (CDEK reference)
     */
    #[Type('int')]
    public ?int $region_code = null;

    /**
     * Locality region FIAS unique identifier
     */
    #[Type('string')]
    public ?string $fias_region_guid = null;

    /**
     * Locality region KLADR code
     */
    #[Type('string')]
    public ?string $kladr_region_code = null;

    /**
     * Locality country name
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

    /**
     * Locality time zone
     */
    #[Type('string')]
    public ?string $time_zone = null;

    /**
     * Cash-on-delivery limit in the locality
     */
    #[Type('float')]
    public ?float $payment_limit = null;
}