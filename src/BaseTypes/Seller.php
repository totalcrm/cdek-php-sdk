<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\BaseTypes;

use JMS\Serializer\Annotation\SkipWhenEmpty;
use JMS\Serializer\Annotation\Type;

class Seller extends Base
{
    /**
     * Actual seller name
     */
    #[Type('string')]
    public ?string $name = null;

    /**
     * Actual seller INN (taxpayer identification number)
     */
    #[SkipWhenEmpty]
    #[Type('int')]
    public ?int $inn = null;

    /**
     * Actual seller phone
     */
    #[Type('string')]
    public ?string $phone = null;

    /**
     * Ownership form code
     */
    #[Type('int')]
    public ?int $ownership_form = null;

    /**
     * Actual seller address.
     * Used when printing invoices to display the actual seller's address or trade name.
     * International orders only
     */
    #[Type('string')]
    public ?string $address = null;
}