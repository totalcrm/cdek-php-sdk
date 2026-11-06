<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;

class Request
{
    /**
     * Request identifier
     */
    #[Type('string')]
    public ?string $request_uuid = null;

    /**
     * Request type.
     * Allowed values: CREATE, UPDATE, DELETE, AUTH, GET
     */
    #[Type('string')]
    public ?string $type = null;

    /**
     * Current request state.
     * Allowed values: ACCEPTED, WAITING, SUCCESSFUL, INVALID
     */
    #[Type('string')]
    public ?string $state = null;

    /**
     * Date and time
     */
    #[Type('string')]
    public ?string $date_time = null;

    /**
     * List of errors
     *
     * @var Error[]
     */
    #[Type('array<TotalCRM\Cdek\Dto\Error>')]
    public ?array $errors = null;

    /**
     * List of warnings
     *
     * @var Warning[]
     */
    #[Type('array<TotalCRM\Cdek\Dto\Warning>')]
    public ?array $warnings = null;
}