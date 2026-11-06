<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\Actions;

use TotalCRM\Cdek\Http\ApiResponse;

trait FilteredTrait
{
    public function getFiltered(array $filter = []): ApiResponse
    {
        return $this->httpClient->get($this->buildFilteredUrl($filter));
    }

    private function buildFilteredUrl(array $filter = []): string
    {
        $query = $this->parseFilter($filter);

        return static::URL . ($query !== '' ? '?' . $query : '');
    }

    private function parseFilter(array $filter = []): string
    {
        if ($filter === []) {
            return '';
        }

        $filtered = array_intersect_key($filter, self::FILTER);

        return http_build_query($filtered);
    }
}