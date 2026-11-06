<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;

class WorkTimeExceptions
{
    /**
     * Date
     */
    #[Type('string')]
    public ?string $date = null;

    /**
     * Working hours on the specified date. Omitted if the office is closed on this date.
     */
    #[Type('string')]
    public ?string $time = null;

    /**
     * Whether the specified date is a working day or a day off
     */
    #[Type('bool')]
    public ?bool $is_working = null;
}