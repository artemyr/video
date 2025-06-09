<?php

namespace Support\DTO\Table;

class TableDto
{
    /** @var TableRowDto */
    public readonly TableRowDto $head;

    /** @var TableRowDto[] */
    public readonly array $body;

    public readonly bool $needRemoveBtn;

    public function __construct(TableRowDto $head, array $body, bool $needRemoveBtn = false)
    {
        $this->head = $head;
        $this->body = $body;
        $this->needRemoveBtn = $needRemoveBtn;
    }

    public static function make(array $head, array $body, array $options = null): TableDto
    {
        $resBody = [];
        foreach ($body as $item) {
            $resBody[] = new TableRowDto($item['values'], $item['detailUrl']);
        }

        $needRemoveBtn = false;
        if ($options['needRemoveBtn']) {
            $needRemoveBtn = true;
        }

        return new self(new TableRowDto($head), $resBody, $needRemoveBtn);
    }
}
