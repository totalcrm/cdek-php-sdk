<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\BaseTypes;

use JMS\Serializer\Annotation\SkipWhenEmpty;
use JMS\Serializer\Annotation\Type;
use TotalCRM\Cdek\Dto\Statuses;

class Intake extends Base
{
    #[Type('string')]
    public ?string $uuid = null;

    #[Type('string')]
    public ?string $order_uuid = null;

    #[Type('int')]
    public ?int $cdek_number = null;

    #[Type('string')]
    public ?string $intake_date = null;

    #[Type('string')]
    public ?string $intake_time_from = null;

    #[Type('string')]
    public ?string $intake_time_to = null;

    #[Type('string')]
    public ?string $lunch_time_from = null;

    #[Type('string')]
    public ?string $lunch_time_to = null;

    #[Type('string')]
    public ?string $name = null;

    #[Type('int')]
    public ?int $weight = null;

    #[Type('int')]
    public ?int $length = null;

    #[Type('int')]
    public ?int $width = null;

    #[Type('int')]
    public ?int $height = null;

    #[Type('string')]
    public ?string $comment = null;

    #[Type('TotalCRM\Cdek\BaseTypes\Contact')]
    public ?Contact $sender = null;

    #[Type('TotalCRM\Cdek\BaseTypes\Location')]
    public ?Location $from_location = null;

    #[Type('bool')]
    public bool $need_call = false;

    /**
     * @var Statuses[]
     */
    #[SkipWhenEmpty]
    #[Type('array<TotalCRM\Cdek\Dto\Statuses>')]
    public ?array $statuses = null;

    public function __construct(array $param = [])
    {
        parent::__construct($param);

        $this->rules = [
            'intake_date' => 'required|date:Y-m-d',
            'intake_time_from' => 'required|date:H:i',
            'intake_time_to' => 'required|date:H:i',
            'weight' => 'numeric',
            'sender' => [
                function (mixed $value): bool {
                    return $value instanceof Contact && $value->validate();
                },
            ],
            'from_location' => [
                function (mixed $value): bool {
                    return $value instanceof Location && $value->validate();
                },
            ],
            'length' => 'numeric',
            'width' => 'numeric',
            'height' => 'numeric',
        ];
    }
}