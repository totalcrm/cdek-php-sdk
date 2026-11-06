<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Actions;

final class LocationCities extends Action
{
    use FilteredTrait;

    public const string URL = '/location/cities';

    public const array FILTER = [
        'country_codes' => '',
        'region_code' => '',
        'kladr_region_code' => '',
        'fias_region_guid' => '',
        'kladr_code' => '',
        'fias_guid' => '',
        'postal_code' => '',
        'code' => '',
        'city' => '',
        'size' => '',
        'page' => '',
        'lang' => '',
        'payment_limit' => '',
    ];
}