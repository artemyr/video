<?php

namespace Support\DTO\Table;

class TableRowDto
{
    /** @var TableColDto[] */
    public readonly array $cols;

    public readonly string $detailUrl;
    public readonly string $deleteUrl;

    public function __construct(array $cols, string $detailUrl = '', string $deleteUrl = '')
    {
        $resCols = [];
        foreach ($cols as $item) {
            $resCols[] = new TableColDto($item);
        }
        $this->cols = $resCols;

        $this->detailUrl = $detailUrl;
        $this->deleteUrl = $deleteUrl;
    }
}
