<?php

namespace Support\Traits\Models;

trait HasVideoGallery
{
    public function video(): ?string
    {
        if (empty($this->video)) {
            return null;
        }

        if (str($this->video)->startsWith('http') ) {
            return $this->video;
        }

        return asset('storage/video/' . $this->video);
    }

    public function getVideoSlideType(): string
    {
        if (empty($this->video)) {
            return 'no';
        }

        if (str($this->video)->startsWith('http') ) {
            return 'external';
        }

        return 'internal';
    }

    public function getExternalVideoLink(): string
    {
        return str($this->video())->ltrim('https:');
    }
}
