<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\BaseTypes;

use JMS\Serializer\Annotation\Type;

class Threshold extends Base
{
    #[Type('int')]
    public ?int $threshold = null;

    #[Type('float')]
    public ?float $sum = null;

    #[Type('float')]
    public ?float $vat_sum = null;

    #[Type('int')]
    public ?int $vat_rate = null;

    public function __construct(array $param = [])
    {
        parent::__construct($param);

        $this->rules = [
            'threshold' => 'required|numeric',
            'sum' => 'required|numeric',
            'vat_sum' => 'numeric',
        ];
    }
}