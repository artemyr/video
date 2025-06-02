<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function url(): string
    {
        return asset('storage/video/' . $this->path);
    }

    public function humanSize(): string
    {
        return number_format($this->size / 1024 / 1024,2,'.',' ') . ' Mb';
    }
}
