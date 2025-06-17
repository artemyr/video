<?php

namespace Support\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Support\ValueObjects\Size;

class SizeCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): Size
    {
        return Size::make($value ?? '');
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        if ( ! $value instanceof Size) {
            $value = Size::make($value);
        }
        return $value->row();
    }
}
