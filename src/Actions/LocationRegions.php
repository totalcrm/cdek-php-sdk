<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Actions;

final class LocationRegions extends Action
{
    use FilteredTrait;

    public const string URL = '/location/regions';

    public const array FILTER = [
        'country_codes' => '',
        'region_code' => '',
        'kladr_region_code' => '',
        'fias_region_guid' => '',
        'size' => '',
        'page' => '',
        'lang' => '',
    ];
}