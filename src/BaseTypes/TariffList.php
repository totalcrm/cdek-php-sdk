<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\BaseTypes;

use JMS\Serializer\Annotation\Type;

class TariffList extends Base
{
    #[Type('string')]
    public ?string $date = null;

    #[Type('int')]
    public ?int $type = null;

    #[Type('int')]
    public ?int $currency = null;

    #[Type('string')]
    public ?string $lang = null;

    #[Type('TotalCRM\Cdek\BaseTypes\Location')]
    public ?Location $from_location = null;

    #[Type('TotalCRM\Cdek\BaseTypes\Location')]
    public ?Location $to_location = null;

    /**
     * @var Package[]
     */
    #[Type('array<TotalCRM\Cdek\BaseTypes\Package>')]
    public ?array $packages = null;

    public function __construct(array $param = [])
    {
        parent::__construct($param);

        $this->rules = [
            'date' => 'date:Y-m-d\TH:i:sO',
            'type' => 'digits_between:1,2',
            'from_location' => [
                'required',
                function (mixed $value): bool {
                    return $value instanceof Location && $value->validate();
                },
            ],
            'to_location' => [
                'required',
                function (mixed $value): bool {
                    return $value instanceof Location && $value->validate();
                },
            ],
            'packages' => [
                'required',
                'array',
                function (mixed $value): bool {
                    if (!is_array($value) || $value === []) {
                        return false;
                    }

                    $valid = 0;
                    foreach ($value as $item) {
                        if ($item instanceof Package && $item->validate()) {
                            $valid++;
                        }
                    }

                    return $valid === count($value);
                },
            ],
        ];
    }
}