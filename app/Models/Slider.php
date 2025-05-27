<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Support\Traits\Models\HasThumbnail;

class Slider extends Model
{
    use HasThumbnail;

    protected $fillable = [
        'title',
        'video',
        'photo',
        'thumbnail',
        'active',
        'sort'
    ];

    protected function thumbnailDir(): string
    {
        return 'slider';
    }

    protected function thumbnailColumn(): string
    {
        return 'photo';
    }

    public function photo(): string
    {
        return asset('storage/images/' . $this->photo);
    }

    public function video(): string
    {
        return asset('storage/video/' . $this->video);
    }
}
