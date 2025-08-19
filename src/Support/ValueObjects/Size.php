<?php

namespace Support\ValueObjects;

use Stringable;
use Support\Traits\Makeable;

class Size implements Stringable
{
    use Makeable;

    private int $height;
    private int $width;

    public function __construct(?string $value)
    {
        if (empty($value)) {
            $value = '0-0';
        }

        if (!str_contains($value, '-')) {
            $value = '0-0';
        }

        [$this->width, $this->height] = explode('-', $value);
    }

    public function row(): string
    {
        return $this->width . '-' . $this->height;
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
        return $this->row();
    }

    public function isEmpty(): bool
    {
        return (empty($this->width) && empty($this->height));
    }
}
