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
use Support\Helpers\Controllers\SliderControllerHelper;

class SliderController
{
    public function index()
    {
        $items = Slider::query()
            ->sorted()
            ->paginate(10);

        $body = [];
        foreach ($items as $item) {
            $video = $item->video();
            if (str($video)->length() > 20) {
                $video = str($video)
                    ->substr(0, 20)
                    ->append('...')
                    ->value();
            }

            $body[] = new TableRowDto([
                $item->id,
                $item->title,
                $item->active,
                new HtmlDto('<img width="100" src="' . $item->image() . '">'),
                $video,
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

        return view('admin.main.slider.index', compact('table', 'items'));
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

        flash()->info(__('crud.destroy.success'));

        return redirect()->route('admin.main.slider.index');
    }

    public function pageCreate()
    {
        return view('admin.main.slider.create');
    }

    public function create(SliderSaveRequest $request)
    {
        (new SliderControllerHelper($request))->create();

        flash()->info(__('crud.create.success'));

        return redirect()->route('admin.main.slider.index');
    }

    public function update(Slider $item, SliderUpdateRequest $request)
    {
        (new SliderControllerHelper($request, $item))->update();

        flash()->info(__('crud.update.success'));

        return redirect()->back();
    }

    public function detail(Slider $item)
    {
        return view('admin.main.slider.detail', compact('item'));
    }
}
