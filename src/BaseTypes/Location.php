<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\BaseTypes;

use JMS\Serializer\Annotation\Type;

class Location extends Base
{
    #[Type('int')]
    public ?int $code = null;

    #[Type('int')]
    public ?int $city_code = null;

    #[Type('string')]
    public ?string $fias_guid = null;

    #[Type('string')]
    public ?string $postal_code = null;

    #[Type('float')]
    public ?float $longitude = null;

    #[Type('float')]
    public ?float $latitude = null;

    #[Type('string')]
    public ?string $country_code = null;

    #[Type('string')]
    public ?string $region = null;

    #[Type('int')]
    public ?int $region_code = null;

    #[Type('string')]
    public ?string $sub_region = null;

    #[Type('string')]
    public ?string $city = null;

    #[Type('string')]
    public ?string $kladr_code = null;

    #[Type('string')]
    public ?string $address = null;

    #[Type('string')]
    public ?string $address_full = null;

    public function __construct(array $param = [])
    {
        parent::__construct($param);

        $this->rules = [
            'address' => 'required',
            'code' => 'required_without:city_code|numeric',
            'city_code' => 'required_without:code|numeric',
            'fias_guid' => 'string',
            'postal_code' => 'string',
            'longitude' => 'numeric',
            'latitude' => 'numeric',
            'country_code' => 'alpha:2',
            'region' => 'string',
            'sub_region' => 'string',
            'city' => 'string',
            'kladr_code' => 'string',
        ];
    }
}