<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use App\Models\Text;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Support\DTO\Table\HtmlDto;
use Support\DTO\Table\TableColDto;
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
                new HtmlDto('<img width="100" src="'. asset('storage/images/'.$item->photo) .'">'),
                $item->video,
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

    public function detail(Slider $item)
    {
        return view('admin.main.slider.detail', compact('item'));
    }
}
