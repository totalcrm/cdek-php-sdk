<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\BaseTypes;

use JMS\Serializer\Annotation\Type;

class Item extends Base
{
    #[Type('string')]
    public ?string $name = null;

    #[Type('string')]
    public ?string $ware_key = null;

    #[Type('string')]
    public ?string $marking = null;

    #[Type('TotalCRM\Cdek\BaseTypes\Money')]
    public ?Money $payment = null;

    #[Type('float')]
    public ?float $cost = null;

    #[Type('int')]
    public ?int $weight = null;

    #[Type('int')]
    public ?int $weight_gross = null;

    #[Type('int')]
    public ?int $amount = null;

    #[Type('int')]
    public ?int $delivery_amount = null;

    #[Type('string')]
    public ?string $name_i18n = null;

    #[Type('string')]
    public ?string $brand = null;

    #[Type('string')]
    public ?string $country_code = null;

    #[Type('int')]
    public ?int $material = null;

    #[Type('bool')]
    public bool $wifi_gsm = false;

    #[Type('string')]
    public ?string $url = null;

    public function __construct(array $param = [])
    {
        parent::__construct($param);

        $this->rules = [
            'name' => 'required',
            'ware_key' => 'required',
            'cost' => 'required|numeric',
            'weight' => 'required|numeric',
            'amount' => 'required|integer',
            'payment' => [
                'required',
                function (mixed $value): bool {
                    return $value instanceof Money && $value->validate();
                },
            ],
            'weight_gross' => 'numeric',
            'country_code' => 'alpha:2',
            'url' => 'url',
        ];
    }
}