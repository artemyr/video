<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PortfolioSaveRequest;
use App\Http\Requests\PortfolioUpdateRequest;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Storage;
use Support\DTO\Table\HtmlDto;
use Support\DTO\Table\TableComponentDto;
use Support\DTO\Table\TableDto;
use Support\Helpers\Controllers\PortfolioControllerHelper;

class PortfolioController
{
    public function index()
    {
        $items = Portfolio::query()
            ->sorted()
            ->paginate(10);

        $rows = [];
        foreach ($items as $item) {
            $video = $item->video();
            if (str($video)->length() > 20) {
                $video = str($video)
                    ->substr(0, 20)
                    ->append('...')
                    ->value();
            }

            $rows[] = [
                'values' => [
                    $item->id,
                    $item->title,
                    $item->sort,
                    $item->active,
                    new HtmlDto('<img width="100" src="' . $item->image() . '">'),
                    $video,
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

        return view('admin.portfolio.index', compact('table', 'items'));
    }

    public function destroy(Portfolio $item)
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

        return redirect()->route('admin.portfolio.index');
    }

    public function pageCreate()
    {
        return view('admin.portfolio.create');
    }

    public function create(PortfolioSaveRequest $request)
    {
        (new PortfolioControllerHelper($request))->create();

        flash()->info(__('crud.create.success'));

        return redirect()->route('admin.portfolio.index');
    }

    public function update(Portfolio $item, PortfolioUpdateRequest $request)
    {
        (new PortfolioControllerHelper($request, $item))->update();

        flash()->info(__('crud.update.success'));

        return redirect()->back();
    }

    public function detail(Portfolio $item)
    {
        return view('admin.portfolio.detail', compact('item'));
    }
}
