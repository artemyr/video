<?php

namespace Support\DTO\Table;

class TableDto
{
    /** @var TableRowDto */
    public readonly TableRowDto $head;

    /** @var TableRowDto[] */
    public readonly array $body;

    public function __construct(TableRowDto $head, array $body)
    {
        $this->head = $head;
        $this->body = $body;
    }

    public static function make(array $head, array $body): TableDto
    {
        $resBody = [];
        foreach ($body as $item) {
            $resBody[] = new TableRowDto($item['values'], $item['detailUrl']);
        }

        return new self(new TableRowDto($head), $resBody);
    }
}
