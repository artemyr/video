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

    public function getExternalVideoLink(): ?string
    {
        if (!str($this->video)->startsWith('https:')) {
            return null;
        }

        return $this->video;
    }

    public function getInternalVideoLink(): ?string
    {
        if (str($this->video)->startsWith('https:')) {
            return null;
        }

        return $this->video();
    }

    public function getExternalVideoLinkForGallery(): ?string
    {
        if (!str($this->video)->startsWith('https:')) {
            return null;
        }

        return str($this->video)->ltrim('https:');
    }
}
