<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\BaseTypes;

use JMS\Serializer\Annotation\Type;

class Phone extends Base
{
    #[Type('string')]
    public ?string $number = null;

    #[Type('string')]
    public ?string $additional = null;

    public function __construct(array $param = [])
    {
        parent::__construct($param);

        $this->rules = [
            'number' => 'required',
        ];
    }
}