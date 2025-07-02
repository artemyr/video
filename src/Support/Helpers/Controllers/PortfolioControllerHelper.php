<?php

namespace Support\Helpers\Controllers;

use App\Models\Portfolio;
use Illuminate\Support\Facades\Storage;
use Support\Helpers\VideoSizeHelper;
use Support\ValueObjects\Size;

class PortfolioControllerHelper
{
    private array $saveFields = [];

    public function __construct(
        private $request = null,
        private $item = null
    ) {
    }

    public function create()
    {
        $fields = $this->request->validated();

        $validateResult = $this->validate();
        if (!empty($validateResult)) {
            return $validateResult;
        }

        $this->saveFields = [
            'active' => $this->request->has('active'),
            'title' => $fields['title'],
            'sort' => $fields['sort'],
            'size' => Size::make($fields['size'])
        ];

        $this->resolveImage();
        $this->resolveVideo();

        Portfolio::query()->create($this->saveFields);
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

    private function validate()
    {
        if (empty($this->request->get('link')) && !$this->request->has('video')) {
            return back()->withErrors([
                'link' => 'Прикрепите видео либо укажите ссылку на видео',
                'video' => 'Прикрепите видео либо укажите ссылку на видео',
            ]);
        }
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
                ->put('portfolio', $this->request->file('image'));
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
                ->put('portfolio', $this->request->file('video'));
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
