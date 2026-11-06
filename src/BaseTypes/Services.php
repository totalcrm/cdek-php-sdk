<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\BaseTypes;

use JMS\Serializer\Annotation\Type;

class Services extends Base
{
    #[Type('string')]
    public ?string $code = null;

    #[Type('float')]
    public ?float $parameter = null;

    #[Type('float')]
    public ?float $sum = null;

    public function __construct(array $param = [])
    {
        parent::__construct($param);

        $this->rules = [
            'code' => 'required|alpha_dash',
            'parameter' => 'numeric',
            'sum' => 'numeric',
        ];
    }
}