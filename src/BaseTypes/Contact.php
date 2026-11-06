<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\BaseTypes;

use JMS\Serializer\Annotation\SkipWhenEmpty;
use JMS\Serializer\Annotation\Type;

class Contact extends Base
{
    #[SkipWhenEmpty]
    #[Type('string')]
    public string $company = '';

    #[Type('string')]
    public string $name = '';

    #[SkipWhenEmpty]
    #[Type('string')]
    public string $email = '';

    /**
     * @var Phone[]
     */
    #[Type('array<TotalCRM\Cdek\BaseTypes\Phone>')]
    public array $phones = [];

    #[SkipWhenEmpty]
    #[Type('string')]
    public ?string $passport_series = null;

    #[SkipWhenEmpty]
    #[Type('string')]
    public ?string $passport_number = null;

    #[SkipWhenEmpty]
    #[Type('string')]
    public ?string $passport_date_of_issue = null;

    #[SkipWhenEmpty]
    #[Type('string')]
    public ?string $passport_organization = null;

    #[SkipWhenEmpty]
    #[Type('string')]
    public ?string $passport_date_of_birth = null;

    #[SkipWhenEmpty]
    #[Type('string')]
    public ?string $tin = null;

    public function __construct(array $param = [])
    {
        parent::__construct($param);

        $this->rules = [
            'name' => 'required',
            'email' => 'email',
            'phones' => [
                'required',
                function (mixed $value): bool {
                    if (!is_array($value) || $value === []) {
                        return false;
                    }

                    $valid = 0;
                    foreach ($value as $item) {
                        if ($item instanceof Phone && $item->validate()) {
                            $valid++;
                        }
                    }

                    return $valid === count($value);
                },
            ],
        ];
    }
}