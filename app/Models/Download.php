<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $guarded = ['created_at'];

    public function url(): string
    {
        return asset('storage/video/' . $this->path);
    }

    public function humanSize(): string
    {
        return number_format($this->size / 1024 / 1024,2,'.',' ') . ' Mb';
    }
}
