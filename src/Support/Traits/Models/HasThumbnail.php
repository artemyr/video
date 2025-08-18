<?php

namespace Support\Traits\Models;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

trait HasThumbnail
{
    abstract protected function thumbnailDir(): string;

    public function makeThumbnail(string $size, string $method = 'resize'): string
    {
        $storage = Storage::disk('images');

        $file = $this->{$this->thumbnailColumn()};

        $realPath = $file;
        $newDirPath = "{$this->thumbnailDir()}/$method/$size/{$this->thumbnailDir()}";
        $resultPath = "{$this->thumbnailDir()}/$method/$size/$file";
        $asset = "{$this->thumbnailDir()}/$method/$size/$file";

        if (!$storage->directoryExists($newDirPath)) {
            $storage->makeDirectory($newDirPath);
        }

        $originalFilePath = $storage->path($realPath);
        if (!file_exists($originalFilePath)) {
            return '';
        }

        if (!$storage->exists($resultPath)) {
            $image = ImageManager::imagick()
                ->read($originalFilePath);

            [$w, $h] = explode('x', $size);

            $image->{$method}($w, $h);

            $image->save($storage->path($resultPath));
        }

        return asset("storage/images/$asset");
    }

    protected function thumbnailColumn(): string
    {
        return 'thumbnail';
    }
}
