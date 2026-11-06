<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;
use TotalCRM\Cdek\BaseTypes\WebHook;

class WebHookList
{
    /**
     * List of webhook subscriptions
     *
     * @var WebHook[]
     */
    #[Type('array<TotalCRM\Cdek\BaseTypes\WebHook>')]
    public array $items = [];
}