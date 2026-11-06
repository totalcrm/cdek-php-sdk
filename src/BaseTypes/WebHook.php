<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\BaseTypes;

use JMS\Serializer\Annotation\Type;

class WebHook extends Base
{
    #[Type('string')]
    public ?string $uuid = null;

    #[Type('string')]
    public ?string $type = null;

    #[Type('string')]
    public ?string $url = null;

    public function __construct(array $param = [])
    {
        parent::__construct($param);

        $this->rules = [
            'type' => 'required|alpha_dash',
            'url' => 'required|url',
        ];
    }
}