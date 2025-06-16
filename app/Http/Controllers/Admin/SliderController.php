<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SliderSaveRequest;
use App\Http\Requests\SliderUpdateRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Support\DTO\Table\HtmlDto;
use Support\DTO\Table\TableComponentDto;
use Support\DTO\Table\TableDto;
use Support\DTO\Table\TableRowDto;

class SliderController
{
    public function index()
    {
        $sliders = Slider::query()
            ->orderBy('sort')
            ->get();

        $body = [];
        foreach ($sliders as $item) {

            $body[] = new TableRowDto([
                $item->id,
                $item->title,
                $item->active,
                new HtmlDto('<img width="100" src="'. $item->image() .'">'),
                new HtmlDto('<a target="_blank" href="' . $item->video() . '">Видео</a>'),
                $item->size,
                $item->sort,
                new TableComponentDto('components.forms.remove-form', [
                    'url' => route('admin.main.slider.destroy', $item->id)
                ]),
            ], route('admin.main.slider.detail', $item->id));
        }

        $head = new TableRowDto([
            'ID',
            'Название',
            'Активность',
            'Фото',
            'Видео',
            'Размер',
            'Сортировка',
            'Удалить',
        ]);

        $table = new TableDto($head, $body);

        return view('admin.main.slider.index', compact('table'));
    }

    public function destroy(Slider $item)
    {
        $storageImages = Storage::disk('images');
        $storageVideos = Storage::disk('video');

        if (!empty($item->image)) {
            $storageImages->delete($item->image);
        }

        if (!empty($item->video)) {
            $storageVideos->delete($item->video);
        }

        $item->delete();

        flash()->info('Запись успешно удалена');

        return redirect()->route('admin.main.slider.index');
    }

    public function pageCreate()
    {
        return view('admin.main.slider.create');
    }

    public function create(SliderSaveRequest $request)
    {
        $fields = $request->validated();
        $saveFields = [
            'active' => $request->has('active'),
            'title' => $fields['title'],
            'sort' => $fields['sort'],
            'size' => $fields['size'],
        ];

        $storageImages = Storage::disk('images');
        $storageVideos = Storage::disk('video');

        if ($request->has('image')) {
            $imagePath = $storageImages
                ->put('slider', $request->file('image'));
            $saveFields['image'] = $imagePath;
        }

        if ($request->has('video')) {
            $videoPath = $storageVideos
                ->put('slider', $request->file('video'));
            $saveFields['video'] = $videoPath;
        }

        Slider::query()->create($saveFields);

        flash()->info('Запись успешно создана');

        return redirect()->route('admin.main.slider.index');
    }

    public function update(Slider $item, SliderUpdateRequest $request)
    {
        $fields = $request->validated();
        $saveFields = [
            'active' => $request->has('active'),
            'title' => $fields['title'],
            'sort' => $fields['sort'],
            'size' => $fields['size'],
        ];

        $storageImages = Storage::disk('images');
        $storageVideos = Storage::disk('video');

        if ($request->has('image') && !empty($item->image)) {
            $storageImages->delete($item->image);
        }

        if ($request->has('video') && !empty($item->video)) {
            $storageVideos->delete($item->video);
        }

        if ($request->has('image')) {
            $imagePath = $storageImages
                ->put('slider', $request->file('image'));
            $saveFields['image'] = $imagePath;
        }

        if ($request->has('video')) {
            $videoPath = $storageVideos
                ->put('slider   ', $request->file('video'));
            $saveFields['video'] = $videoPath;
        }

        $item->update($saveFields);

        flash()->info('Запись успешно обновлена');

        return redirect()->back();
    }

    public function detail(Slider $item)
    {
        return view('admin.main.slider.detail', compact('item'));
    }
}
