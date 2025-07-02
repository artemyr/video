<?php

namespace Support\ValueObjects;

use InvalidArgumentException;
use Stringable;
use Support\Traits\Makeable;

class Size implements Stringable
{
    use Makeable;

    private int $height;
    private int $width;

    public function __construct(
        private readonly ?string $value,
    ) {
        if (empty($value)) {
            $value = '0-0';
        }

        if (!str_contains($value, '-')) {
            throw new InvalidArgumentException('Uncorrect value: ' . $value);
        }

        [$this->width, $this->height] = explode('-', $value);
    }

    public function row(): string
    {
        return $this->value;
    }

    public function height(): int
    {
        return $this->height;
    }

    public function width(): int
    {
        return $this->width;
    }

    public function empty(): bool
    {
        return ($this->height() === 0 || $this->width() === 0);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
