<?php

namespace Support\Helpers\Controllers;

use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Support\Helpers\VideoSizeHelper;
use Support\ValueObjects\Size;

class SliderControllerHelper
{
    private array $saveFields = [];

    public function __construct(
        private $request = null,
        private $item = null
    ) {
    }

    public function create(): void
    {
        $fields = $this->request->validated();
        $this->saveFields = [
            'active' => $this->request->has('active'),
            'title' => $fields['title'],
            'sort' => $fields['sort'],
            'size' => Size::make($fields['size'])
        ];

        $this->resolveImage();
        $this->resolveVideo();

        Slider::query()->create($this->saveFields);
    }

    public function update(): void
    {
        $fields = $this->request->validated();
        $this->saveFields = [
            'active' => $this->request->has('active'),
            'title' => $fields['title'],
            'sort' => $fields['sort'],
            'size' => Size::make($fields['size'])
        ];

        $this->resolveImage();
        $this->resolveVideo();

        $this->item->update($this->saveFields);
    }

    private function resolveImage(): void
    {
        $storageImages = Storage::disk('images');

        if ($this->isNeedDeleteCurrentImage()) {
            if ($storageImages->exists($this->item->image)) {
                $storageImages->delete($this->item->image);
            }
        }

        if ($this->request->has('image')) {
            $imagePath = $storageImages
                ->put('slider', $this->request->file('image'));
            $this->saveFields['image'] = $imagePath;
        }
    }

    private function resolveVideo(): void
    {
        $storageVideos = Storage::disk('video');

        if ($this->isNeedDeleteCurrentVideo()) {
            if ($storageVideos->exists($this->item->video)) {
                $storageVideos->delete($this->item->video);
            }
        }

        if (!empty($this->request->get('link'))) {
            $this->saveFields['video'] = $this->request->get('link');
            return;
        }

        if ($this->request->has('video')) {
            $videoPath = $storageVideos
                ->put('slider', $this->request->file('video'));
            $this->saveFields['video'] = $videoPath;

            if ($this->saveFields['size']->empty()) {
                $this->saveFields['size'] = VideoSizeHelper::analyze($storageVideos->path($videoPath));
            }
        }
    }

    private function isNeedDeleteCurrentImage(): bool
    {
        return ($this->request->has('image') && !empty($this->item->image));
    }

    private function isNeedDeleteCurrentVideo(): bool
    {
        return ( ($this->request->has('video') || $this->request->has('link') ) && !empty($this->item->video));
    }
}
