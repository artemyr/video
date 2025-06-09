<?php

namespace Support\DTO\Table;

class TableComponentDto
{
    public readonly string $name;
    public readonly array $props;

    public function __construct(string $name, array $props)
    {
        $this->name = $name;
        $this->props = $props;
    }
}
