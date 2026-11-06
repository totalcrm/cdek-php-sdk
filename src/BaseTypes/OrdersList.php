<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\BaseTypes;

use JMS\Serializer\Annotation\Type;

class OrdersList extends Base
{
    #[Type('string')]
    public ?string $order_uuid = null;

    #[Type('int')]
    public ?int $cdek_number = null;

    public function __construct(array $param = [])
    {
        parent::__construct($param);

        $this->rules = [
            'order_uuid' => 'alpha_dash',
            'cdek_number' => 'required_without:order_uuid|integer',
        ];
    }
}