<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;
use TotalCRM\Cdek\BaseTypes\Dimensions;
use TotalCRM\Cdek\BaseTypes\Location;
use TotalCRM\Cdek\BaseTypes\Phone;

class PickupPoint
{
    /**
     * Pickup point code
     */
    #[Type('string')]
    public ?string $code = null;

    /**
     * Pickup point name
     */
    #[Type('string')]
    public ?string $name = null;

    /**
     * Pickup point address
     */
    #[Type('TotalCRM\Cdek\BaseTypes\Location')]
    public ?Location $location = null;

    /**
     * Opening hours, e.g. "Mon-Fri 9-18, Sat 9-16"
     */
    #[Type('string')]
    public ?string $work_time = null;

    /**
     * Pickup point note
     */
    #[Type('string')]
    public ?string $note = null;

    /**
     * Minimum accepted weight (kg) at the pickup point (> weight_min)
     */
    #[Type('float')]
    public ?float $weight_min = null;

    /**
     * Maximum accepted weight (kg) at the pickup point (<= weight_max)
     */
    #[Type('float')]
    public ?float $weight_max = null;

    /**
     * Pickup point type: CDEK warehouse or partner parcel locker.
     * PVZ — CDEK warehouse, POSTOMAT — CDEK partner parcel locker
     */
    #[Type('string')]
    public ?string $type = null;

    /**
     * Company the pickup point belongs to
     */
    #[Type('string')]
    public ?string $owner_code = null;

    /**
     * Whether the pickup point is drop-off only or also accepts incoming parcels
     */
    #[Type('bool')]
    public ?bool $take_only = null;

    /**
     * Fitting room available
     */
    #[Type('bool')]
    public ?bool $is_dressing_room = null;

    /**
     * Cashless payment terminal available
     */
    #[Type('bool')]
    public ?bool $have_cashless = null;

    /**
     * Cash payment accepted
     */
    #[Type('bool')]
    public ?bool $have_cash = null;

    /**
     * Cash-on-delivery allowed at the pickup point
     */
    #[Type('bool')]
    public ?bool $allowed_cod = null;

    /**
     * Nearest transport stop/station
     */
    #[Type('string')]
    public ?string $nearest_station = null;

    /**
     * Nearest metro station
     */
    #[Type('string')]
    public ?string $nearest_metro_station = null;

    /**
     * Link to this pickup point on the CDEK website
     */
    #[Type('string')]
    public ?string $site = null;

    /**
     * Email address
     */
    #[Type('string')]
    public ?string $email = null;

    /**
     * Location description
     */
    #[Type('string')]
    public ?string $address_comment = null;

    /**
     * All office photos
     *
     * @var PickupImage[]
     */
    #[Type('array<TotalCRM\Cdek\Dto\PickupImage>')]
    public ?array $office_image_list = null;

    /**
     * Weekly opening hours
     *
     * @var WorkTime[]
     */
    #[Type('array<TotalCRM\Cdek\Dto\WorkTime>')]
    public ?array $work_time_list = null;

    /**
     * Office opening hours exceptions
     *
     * @var WorkTimeExceptions[]
     */
    #[Type('array<TotalCRM\Cdek\Dto\WorkTimeExceptions>')]
    public ?array $work_time_exceptions = null;

    /**
     * @var Phone[]
     */
    #[Type('array<TotalCRM\Cdek\BaseTypes\Phone>')]
    public ?array $phones = null;

    /**
     * @var Dimensions[]
     */
    #[Type('array<TotalCRM\Cdek\BaseTypes\Dimensions>')]
    public ?array $dimensions = null;
}