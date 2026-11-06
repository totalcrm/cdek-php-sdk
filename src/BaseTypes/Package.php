<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\BaseTypes;

use JMS\Serializer\Annotation\Type;

class Package extends Base
{
    #[Type('string')]
    public ?string $package_id = null;

    #[Type('string')]
    public ?string $number = null;

    #[Type('int')]
    public ?int $weight = null;

    #[Type('int')]
    public ?int $weight_volume = null;

    #[Type('int')]
    public ?int $weight_calc = null;

    #[Type('int')]
    public ?int $length = null;

    #[Type('int')]
    public ?int $width = null;

    #[Type('int')]
    public ?int $height = null;

    #[Type('string')]
    public ?string $comment = null;

    /**
     * @var Item[]
     */
    #[Type('array<TotalCRM\Cdek\BaseTypes\Item>')]
    public ?array $items = null;

    public function __construct(array $param = [])
    {
        parent::__construct($param);

        $this->rules = [
            'number' => 'required',
            'weight' => 'required|numeric',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'items' => [
                'required',
                'array',
                function (mixed $value): bool {
                    if (!is_array($value) || $value === []) {
                        return false;
                    }

                    $valid = 0;
                    foreach ($value as $item) {
                        if ($item instanceof Item && $item->validate()) {
                            $valid++;
                        }
                    }

                    return $valid === count($value);
                },
            ],
        ];
    }
}