<?php

declare(strict_types=1);

namespace TotalCRM\Cdek\BaseTypes;

use JMS\Serializer\Annotation as Serializer;

class Base
{
    #[Serializer\Exclude]
    protected array $rules = [];

    #[Serializer\Exclude]
    protected array $validationErrors = [];

    public function __construct(array $param = [])
    {
        foreach ($param as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $this->castValue($key, $value);
            }
        }
    }

    public function validate(): bool
    {
        $this->validationErrors = [];
        $data = get_object_vars($this);

        foreach ($this->rules as $field => $ruleSet) {
            $value = $data[$field] ?? null;
            $ruleList = is_array($ruleSet) ? $ruleSet : explode('|', (string) $ruleSet);

            foreach ($ruleList as $rule) {
                $error = $this->applyRule($field, $value, $rule, $data);
                if ($error !== null) {
                    $this->validationErrors[$field][] = $error;
                    break;
                }
            }
        }

        return $this->validationErrors === [];
    }

    /**
     * @return string[]
     */
    public function getValidationErrors(): array
    {
        $flat = [];
        foreach ($this->validationErrors as $fieldErrors) {
            foreach ($fieldErrors as $message) {
                $flat[] = $message;
            }
        }

        return $flat;
    }

    private function castValue(string $key, mixed $value): mixed
    {
        if ($value === null) {
            return null;
        }

        $reflection = new \ReflectionProperty($this, $key);
        $type = $reflection->getType();

        if (!$type instanceof \ReflectionNamedType) {
            return $value;
        }

        return match ($type->getName()) {
            'int' => is_numeric($value) ? (int) $value : $value,
            'float' => is_numeric($value) ? (float) $value : $value,
            'string' => is_scalar($value) ? (string) $value : $value,
            'bool' => is_scalar($value) ? (bool) $value : $value,
            default => $value,
        };
    }

    /**
     * @param array<string, mixed> $data
     */
    private function applyRule(string $field, mixed $value, mixed $rule, array $data): ?string
    {
        if ($rule instanceof \Closure || (is_object($rule) && is_callable($rule))) {
            return $rule($value, $data) ? null : sprintf('%s is invalid', $field);
        }

        if (!is_string($rule) || $rule === '') {
            return null;
        }

        [$name, $arg] = array_pad(explode(':', $rule, 2), 2, null);

        return match ($name) {
            'required' => $this->isEmpty($value) ? sprintf('%s is required', $field) : null,
            'required_without' => $this->isEmpty($data[$arg] ?? null) && $this->isEmpty($value)
                ? sprintf('%s is required when %s is empty', $field, $arg) : null,
            'required_if' => $this->matchesRequiredIf($value, $arg, $data)
                ? null : sprintf('%s is required', $field),
            'numeric' => $this->isEmpty($value) || is_numeric($value)
                ? null : sprintf('%s must be numeric', $field),
            'integer' => $this->isEmpty($value) || filter_var($value, FILTER_VALIDATE_INT) !== false
                ? null : sprintf('%s must be an integer', $field),
            'string' => $this->isEmpty($value) || is_string($value)
                ? null : sprintf('%s must be a string', $field),
            'email' => $this->isEmpty($value) || filter_var($value, FILTER_VALIDATE_EMAIL) !== false
                ? null : sprintf('%s must be a valid email', $field),
            'url' => $this->isEmpty($value) || filter_var($value, FILTER_VALIDATE_URL) !== false
                ? null : sprintf('%s must be a valid URL', $field),
            'alpha' => $this->isEmpty($value)
            || preg_match('/^[a-zA-Z' . ($arg !== null ? '{' . $arg . '}' : '+') . ']$/', (string) $value) === 1
                ? null : sprintf('%s must contain only letters', $field),
            'alpha_dash' => $this->isEmpty($value)
            || preg_match('/^[a-zA-Z0-9_-]+$/', (string) $value) === 1
                ? null : sprintf('%s must contain only letters, digits, dashes and underscores', $field),
            'array' => $value === null || is_array($value)
                ? null : sprintf('%s must be an array', $field),
            'date' => $this->isValidDate($value, $arg, $field),
            'digits_between' => $this->isEmpty($value)
                ? null : $this->isValidDigitsBetween($value, (string) $arg, $field),
            default => null,
        };
    }

    private function isEmpty(mixed $value): bool
    {
        return $value === null || $value === '' || $value === [];
    }

    /**
     * @param array<string, mixed> $data
     */
    private function matchesRequiredIf(mixed $value, ?string $arg, array $data): bool
    {
        if ($arg === null) {
            return !$this->isEmpty($value);
        }

        [$otherField, $operator, $expected] = array_pad(explode(',', $arg, 3), 3, null);
        $otherValue = $data[$otherField] ?? null;

        $condition = match ($operator) {
            '!=' => $otherValue != $expected,
            default => $otherValue == $expected,
        };

        return $condition ? !$this->isEmpty($value) : true;
    }

    private function isValidDate(mixed $value, ?string $format, string $field): ?string
    {
        if ($this->isEmpty($value)) {
            return null;
        }

        $format ??= 'Y-m-d';
        $value = (string) $value;
        $dt = \DateTimeImmutable::createFromFormat($format, $value);

        if ($dt !== false && $dt->format($format) === $value) {
            return null;
        }

        if ($format === 'Y-m-d\TH:i:sO') {
            $altFormat = 'Y-m-d\TH:i:sP';
            $altDt = \DateTimeImmutable::createFromFormat($altFormat, $value);
            if ($altDt !== false && $altDt->format($altFormat) === $value) {
                return null;
            }
        }

        return sprintf('%s has an invalid date format', $field);
    }

    private function isValidDigitsBetween(mixed $value, string $arg, string $field): ?string
    {
        [$min, $max] = array_pad(explode(',', $arg), 2, null);

        if (!is_numeric($value)) {
            return sprintf('%s must be numeric', $field);
        }

        $digits = strlen((string) $value);
        $min = $min !== null ? (int) $min : 0;
        $max = $max !== null ? (int) $max : PHP_INT_MAX;

        return ($digits >= $min && $digits <= $max)
            ? null
            : sprintf('%s must have between %d and %d digits', $field, $min, $max);
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function create(array $data = []): static
    {
        return new static($data);
    }
}