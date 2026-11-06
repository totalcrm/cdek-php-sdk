<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;
use TotalCRM\Cdek\BaseTypes\Contact;
use TotalCRM\Cdek\BaseTypes\Location;
use TotalCRM\Cdek\BaseTypes\Money;
use TotalCRM\Cdek\BaseTypes\Package;
use TotalCRM\Cdek\BaseTypes\Seller;
use TotalCRM\Cdek\BaseTypes\Services;
use TotalCRM\Cdek\BaseTypes\Threshold;

class OrderInfo
{
    /**
     * Order identifier
     */
    #[Type('string')]
    public ?string $uuid = null;

    /**
     * Order type
     */
    #[Type('int')]
    public ?int $type = null;

    /**
     * Return order flag
     */
    #[Type('bool')]
    public ?bool $is_return = null;

    /**
     * Order number in the CDEK system
     */
    #[Type('int')]
    public ?int $cdek_number = null;

    /**
     * Order number in the client IS
     */
    #[Type('string')]
    public ?string $number = null;

    /**
     * Tariff code
     */
    #[Type('int')]
    public ?int $tariff_code = null;

    /**
     * Order comment
     */
    #[Type('string')]
    public ?string $comment = null;

    /**
     * Developer key
     */
    #[Type('string')]
    public ?string $developer_key = null;

    /**
     * Pickup point code for shipment
     */
    #[Type('string')]
    public ?string $shipment_point = null;

    /**
     * CDEK pickup point code for delivery
     */
    #[Type('string')]
    public ?string $delivery_point = null;

    /**
     * Currency code for declared item value
     */
    #[Type('string')]
    public ?string $items_cost_currency = null;

    /**
     * Currency code for cash-on-delivery
     */
    #[Type('string')]
    public ?string $recipient_currency = null;

    /**
     * Invoice date
     */
    #[Type('string')]
    public ?string $date_invoice = null;

    /**
     * Consignor name
     */
    #[Type('string')]
    public ?string $shipper_name = null;

    /**
     * Consignor address
     */
    #[Type('string')]
    public ?string $shipper_address = null;

    /**
     * Delivery cost charged to the recipient by the online store
     */
    #[Type('TotalCRM\Cdek\BaseTypes\Money')]
    public ?Money $delivery_recipient_cost = null;

    /**
     * Additional delivery fee (charged to the recipient by the online store) depending on the order total
     *
     * @var Threshold[]
     */
    #[Type('array<TotalCRM\Cdek\BaseTypes\Threshold>')]
    public ?array $delivery_recipient_cost_adv = null;

    /**
     * Sender
     */
    #[Type('TotalCRM\Cdek\BaseTypes\Contact')]
    public ?Contact $sender = null;

    /**
     * Actual seller details
     */
    #[Type('TotalCRM\Cdek\BaseTypes\Seller')]
    public ?Seller $seller = null;

    /**
     * Recipient
     */
    #[Type('TotalCRM\Cdek\BaseTypes\Contact')]
    public ?Contact $recipient = null;

    /**
     * Shipment address
     */
    #[Type('TotalCRM\Cdek\BaseTypes\Location')]
    public ?Location $from_location = null;

    /**
     * Delivery address
     */
    #[Type('TotalCRM\Cdek\BaseTypes\Location')]
    public ?Location $to_location = null;

    /**
     * Additional services
     *
     * @var Services[]
     */
    #[Type('array<TotalCRM\Cdek\BaseTypes\Services>')]
    public ?array $services = null;

    /**
     * List of package details
     *
     * @var Package[]
     */
    #[Type('array<TotalCRM\Cdek\BaseTypes\Package>')]
    public ?array $packages = null;

    /**
     * Order statuses sorted by date and time
     *
     * @var Statuses[]
     */
    #[Type('array<TotalCRM\Cdek\Dto\Statuses>')]
    public ?array $statuses = null;

    /**
     * Delivery details
     */
    #[Type('TotalCRM\Cdek\Dto\DeliveryDetail')]
    public ?DeliveryDetail $delivery_detail = null;
}