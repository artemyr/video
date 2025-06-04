<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Support\Traits\Models\HasThumbnail;

class Slider extends Model
{
    use HasThumbnail;

    protected $guarded = [];

    protected function thumbnailDir(): string
    {
        return 'slider';
    }

    protected function thumbnailColumn(): string
    {
        return 'photo';
    }

    public function photo(): ?string
    {
        if (empty($this->photo)) {
            return null;
        }

        return asset('storage/images/' . $this->photo);
    }

    public function video(): ?string
    {
        if (empty($this->video)) {
            return null;
        }

        return asset('storage/video/' . $this->video);
    }
}
