<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PortfolioSaveRequest;
use App\Http\Requests\PortfolioUpdateRequest;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Storage;
use Support\DTO\Table\HtmlDto;
use Support\DTO\Table\TableComponentDto;
use Support\DTO\Table\TableDto;

class PortfolioController
{
    public function index()
    {
        $items = Portfolio::query()
            ->orderBy('sort')
            ->get();

        $rows = [];
        foreach ($items as $item) {
            $rows[] = [
                'values' => [
                    $item->id,
                    $item->title,
                    $item->sort,
                    $item->active,
                    new HtmlDto('<img width="100" src="'. asset('storage/images/'.$item->image) .'">'),
                    $item->video,
                    $item->size,
                    new TableComponentDto('components.forms.remove-form', [
                        'url' => route('admin.portfolio.destroy', $item->id)
                    ]),
                ],
                'detailUrl' => route('admin.portfolio.detail', $item->id)
            ];
        }

        $table = TableDto::make([
            'ID',
            'Название',
            'Сортировка',
            'Активность',
            'Картинка',
            'Видео',
            'Размер',
            'Удалить',
        ], $rows);

        return view('admin.portfolio.index', compact('table'));
    }

    public function destroy(Portfolio $item)
    {
        $item->delete();
        return redirect()->route('admin.portfolio.index');
    }

    public function pageCreate()
    {
        return view('admin.portfolio.create');
    }

    public function create(PortfolioSaveRequest $request)
    {
        Portfolio::query()->create($request->validated());

        return redirect()->route('admin.portfolio.index');
    }

    public function update(Portfolio $item, PortfolioUpdateRequest $request)
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
                ->put('portfolio', $request->file('image'));
            $saveFields['image'] = $imagePath;
        }

        if ($request->has('video')) {
            $videoPath = $storageVideos
                ->put('portfolio', $request->file('video'));
            $saveFields['video'] = $videoPath;
        }

        $item->update($saveFields);

        return redirect()->back();
    }

    public function detail(Portfolio $item)
    {
        return view('admin.portfolio.detail', compact('item'));
    }
}
