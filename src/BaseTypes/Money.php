<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\BaseTypes;

use JMS\Serializer\Annotation\Type;

class Money extends Base
{
    #[Type('float')]
    public ?float $value = null;

    #[Type('float')]
    public ?float $vat_sum = null;

    #[Type('int')]
    public ?int $vat_rate = null;

    public function __construct(array $param = [])
    {
        parent::__construct($param);

        $this->rules = [
            'value' => 'required|numeric',
            'vat_sum' => 'numeric',
        ];
    }
}