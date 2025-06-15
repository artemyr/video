<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Support\Traits\Models\HasThumbnail;

class Slider extends Model
{
    use HasThumbnail;

    protected $guarded = ['created_at'];

    protected function thumbnailDir(): string
    {
        return 'slider';
    }

    protected function thumbnailColumn(): string
    {
        return 'image';
    }

    public function image(): ?string
    {
        if (empty($this->image)) {
            return null;
        }

        return asset('storage/images/' . $this->image);
    }

    public function video(): ?string
    {
        if (empty($this->video)) {
            return null;
        }

        return asset('storage/video/' . $this->video);
    }
}
