<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;

class WorkTime
{
    /**
     * Day ordinal starting from one. Monday = 1, Sunday = 7.
     */
    #[Type('int')]
    public ?int $day = null;

    /**
     * Working hours for this day. Omitted if the office is closed on this day.
     */
    #[Type('string')]
    public ?string $time = null;
}