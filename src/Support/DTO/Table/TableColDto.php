<?php

namespace Support\DTO\Table;

class TableColDto
{
    public readonly string $value;
    public readonly HtmlDto $html;
    public readonly TableComponentDto $component;

    public function __construct(mixed $value)
    {
        if ($value instanceof TableComponentDto) {
            $this->component = $value;
        } elseif ($value instanceof HtmlDto) {
            $this->html = $value;
        } else {
            $this->value = $value ?? 'empty';
        }
    }
}
