<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Support\Traits\Models\HasThumbnail;

class Review extends Model
{
    use HasThumbnail;

    protected $guarded = ['created_at'];

    protected function thumbnailDir(): string
    {
        return 'reviews';
    }

    protected function thumbnailColumn(): string
    {
        return 'image';
    }
}
