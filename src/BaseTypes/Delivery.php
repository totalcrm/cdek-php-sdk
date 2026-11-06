<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\BaseTypes;

use JMS\Serializer\Annotation\SkipWhenEmpty;
use JMS\Serializer\Annotation\Type;

class Delivery extends Base
{
    #[Type('string')]
    public ?string $cdek_number = null;

    #[Type('string')]
    public ?string $order_uuid = null;

    #[Type('string')]
    public ?string $date = null;

    #[Type('string')]
    public ?string $time_from = null;

    #[Type('string')]
    public ?string $time_to = null;

    #[Type('string')]
    public ?string $comment = null;

    #[SkipWhenEmpty]
    #[Type('string')]
    public ?string $delivery_point = null;

    #[Type('TotalCRM\Cdek\BaseTypes\Location')]
    public ?Location $to_location = null;

    public function __construct(array $param = [])
    {
        parent::__construct($param);

        $this->rules = [
            'cdek_number' => 'required_without:order_uuid|string',
            'order_uuid' => 'required_without:cdek_number|string',
            'date' => 'required|date',
            'to_location' => [
                function (mixed $value): bool {
                    return $value instanceof Location && $value->validate();
                },
            ],
        ];
    }
}