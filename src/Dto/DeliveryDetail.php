<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;

class DeliveryDetail
{
    /**
     * Delivery date
     */
    #[Type('string')]
    public ?string $date = null;

    /**
     * Recipient name on delivery
     */
    #[Type('string')]
    public ?string $recipient_name = null;

    /**
     * Cash-on-delivery amount collected from the recipient,
     * in the recipient country's currency, RUB by default, adjusted for partial delivery
     */
    #[Type('float')]
    public ?float $payment_sum = null;

    /**
     * Delivery service cost
     */
    #[Type('float')]
    public ?float $delivery_sum = null;

    /**
     * Order total
     */
    #[Type('float')]
    public ?float $total_sum = null;
}