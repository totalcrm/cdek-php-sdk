<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\BaseTypes;

use JMS\Serializer\Annotation\SkipWhenEmpty;
use JMS\Serializer\Annotation\Type;

class Order extends Base
{
    #[SkipWhenEmpty]
    #[Type('string')]
    public ?string $uuid = null;

    #[Type('int')]
    public ?int $type = 1;

    #[Type('int')]
    public ?int $cdek_number = null;

    #[Type('string')]
    public ?string $number = null;

    #[Type('int')]
    public ?int $tariff_code = null;

    #[Type('string')]
    public ?string $comment = null;

    #[Type('string')]
    public ?string $developer_key = null;

    #[SkipWhenEmpty]
    #[Type('string')]
    public ?string $shipment_point = null;

    #[SkipWhenEmpty]
    #[Type('string')]
    public ?string $delivery_point = null;

    #[SkipWhenEmpty]
    #[Type('string')]
    public ?string $items_cost_currency = null;

    #[SkipWhenEmpty]
    #[Type('string')]
    public ?string $recipient_currency = null;

    #[Type('string')]
    public ?string $date_invoice = null;

    #[Type('string')]
    public ?string $shipper_name = null;

    #[Type('string')]
    public ?string $shipper_address = null;

    #[Type('TotalCRM\Cdek\BaseTypes\Money')]
    public ?Money $delivery_recipient_cost = null;

    /**
     * @var Threshold[]
     */
    #[Type('array<TotalCRM\Cdek\BaseTypes\Threshold>')]
    public ?array $delivery_recipient_cost_adv = null;

    #[Type('TotalCRM\Cdek\BaseTypes\Contact')]
    public ?Contact $sender = null;

    #[Type('TotalCRM\Cdek\BaseTypes\Seller')]
    public ?Seller $seller = null;

    #[Type('TotalCRM\Cdek\BaseTypes\Contact')]
    public ?Contact $recipient = null;

    #[Type('TotalCRM\Cdek\BaseTypes\Location')]
    public ?Location $from_location = null;

    #[Type('TotalCRM\Cdek\BaseTypes\Location')]
    public ?Location $to_location = null;

    /**
     * @var Services[]
     */
    #[Type('array<TotalCRM\Cdek\BaseTypes\Services>')]
    public ?array $services = null;

    /**
     * @var Package[]
     */
    #[Type('array<TotalCRM\Cdek\BaseTypes\Package>')]
    public ?array $packages = null;

    public function __construct(array $param = [])
    {
        parent::__construct($param);

        $this->rules = [
            'tariff_code' => 'required|numeric',
            'services' => 'array',
            'sender' => [
                'required',
                function (mixed $value): bool {
                    return $value instanceof Contact && $value->validate();
                },
            ],
            'recipient' => [
                'required',
                function (mixed $value): bool {
                    return $value instanceof Contact && $value->validate();
                },
            ],
            'from_location' => [
                'required',
                function (mixed $value): bool {
                    return $value instanceof Location && $value->validate();
                },
            ],
            'to_location' => [
                'required',
                function (mixed $value): bool {
                    return $value instanceof Location && $value->validate();
                },
            ],
            'packages' => [
                'required',
                'array',
                function (mixed $value): bool {
                    if (!is_array($value) || $value === []) {
                        return false;
                    }

                    $valid = 0;
                    foreach ($value as $item) {
                        if ($item instanceof Package && $item->validate()) {
                            $valid++;
                        }
                    }

                    return $valid === count($value);
                },
            ],
        ];
    }
}