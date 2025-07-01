<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ReviewSaveRequest;
use App\Http\Requests\ReviewUpdateRequest;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;
use Support\DTO\Table\HtmlDto;
use Support\DTO\Table\TableComponentDto;
use Support\DTO\Table\TableDto;
use Support\DTO\Table\TableRowDto;

class ReviewController
{
    public function index()
    {
        $items = Review::query()
            ->sorted()
            ->paginate(10);

        $body = [];
        foreach ($items as $item) {
            $body[] = new TableRowDto([
                $item->id,
                $item->title,
                $item->active,
                new HtmlDto('<img width="100" src="' . $item->image() . '">'),
                $item->sort,
                new TableComponentDto('components.forms.remove-form', [
                    'url' => route('admin.review.destroy', $item->id)
                ]),
            ], route('admin.review.detail', $item->id));
        }

        $head = new TableRowDto([
            'ID',
            'Название',
            'Активность',
            'Фото',
            'Сортировка',
            'Удалить',
        ]);

        $table = new TableDto($head, $body);

        return view('admin.review.index', compact('table', 'items'));
    }

    public function destroy(Review $item)
    {
        $storageImages = Storage::disk('images');

        if (!empty($item->image)) {
            if ($storageImages->exists($item->image)) {
                $storageImages->delete($item->image);
            }
        }

        $item->delete();

        flash()->info(__('crud.destroy.success'));

        return redirect()->route('admin.review.index');
    }

    public function pageCreate()
    {
        return view('admin.review.create');
    }

    public function create(ReviewSaveRequest $request)
    {
        $fields = $request->validated();
        $saveFields = [
            'active' => $request->has('active'),
            'title' => $fields['title'],
            'sort' => $fields['sort'],
        ];

        $storageImages = Storage::disk('images');

        if ($request->has('image')) {
            $imagePath = $storageImages
                ->put('reviews', $request->file('image'));
            $saveFields['image'] = $imagePath;
        }

        Review::query()->create($saveFields);

        flash()->info(__('crud.create.success'));

        return redirect()->route('admin.review.index');
    }

    public function update(Review $item, ReviewUpdateRequest $request)
    {
        $fields = $request->validated();
        $saveFields = [
            'active' => $request->has('active'),
            'title' => $fields['title'],
            'sort' => $fields['sort'],
        ];

        $storageImages = Storage::disk('images');

        if ($request->has('image') && !empty($item->image)) {
            if ($storageImages->exists($item->image)) {
                $storageImages->delete($item->image);
            }
        }

        if ($request->has('image')) {
            $imagePath = $storageImages
                ->put('reviews', $request->file('image'));
            $saveFields['image'] = $imagePath;
        }

        $item->update($saveFields);

        flash()->info(__('crud.update.success'));

        return redirect()->back();
    }

    public function detail(Review $item)
    {
        return view('admin.review.detail', compact('item'));
    }
}
