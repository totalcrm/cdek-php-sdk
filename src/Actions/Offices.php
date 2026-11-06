<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Actions;

final class Offices extends Action
{
    use FilteredTrait;

    public const string URL = '/deliverypoints';

    public const array FILTER = [
        'postal_code' => '',
        'city_code' => '',
        'type' => '',
        'country_code' => '',
        'region_code' => '',
        'have_cashless' => '',
        'have_cash' => '',
        'allowed_cod' => '',
        'is_dressing_room' => '',
        'weight_max' => '',
        'weight_min' => '',
        'lang' => '',
        'take_only' => '',
    ];
}