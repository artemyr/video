<?php

namespace Support\DTO\Table;

class TableColDto
{
    public readonly string $value;
    public readonly TableComponentDto $component;

    public function __construct(mixed $value)
    {
        if ($value instanceof TableComponentDto) {
            $this->component = $value;
        } else {
            $this->value = $value ?? 'empty';
        }
    }
}
