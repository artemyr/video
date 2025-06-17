<?php

namespace Support\Helpers;

use getID3;
use Support\ValueObjects\Size;

class VideoSizeHelper
{

    public static function analyze(string $fullPath): Size
    {
        $getID3 = new getID3;
        $file = $getID3->analyze($fullPath);

        $width = (int)$file['video']['resolution_x'] ?? 0;
        $height = (int)$file['video']['resolution_y'] ?? 0;

         return Size::make("$width-$height");
    }
}
