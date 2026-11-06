<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Dto;

use JMS\Serializer\Annotation\Type;

class PickupPointList
{
    /**
     * @var PickupPoint[]
     */
    #[Type('array<TotalCRM\Cdek\Dto\PickupPoint>')]
    public array $items = [];

    public function getCount(): int
    {
        return count($this->items);
    }

    /**
     * @param array<string, mixed> $filter
     * @return PickupPoint[]
     */
    public function filter(array $filter = []): array
    {
        $filtered = [];

        foreach ($this->items as $pvz) {
            foreach ($filter as $key => $value) {
                if (property_exists($pvz, $key) && $this->matches($pvz->{$key}, $value)) {
                    $filtered[] = $pvz;
                    break;
                }
            }
        }

        return $filtered;
    }

    private function matches(mixed $actual, mixed $expected): bool
    {
        if (!is_scalar($actual) || !is_scalar($expected)) {
            return false;
        }

        if (is_bool($actual) || is_bool($expected)) {
            return (bool) $actual === (bool) $expected;
        }

        return mb_strtolower((string) $actual) === mb_strtolower((string) $expected);
    }
}