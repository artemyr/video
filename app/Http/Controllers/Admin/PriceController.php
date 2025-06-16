<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PriceRequest;
use App\Models\Price;
use Support\DTO\Table\TableComponentDto;
use Support\DTO\Table\TableDto;
use Support\DTO\Table\TableRowDto;

class PriceController
{
    public function index()
    {
        $items = Price::query()
            ->sorted()
            ->paginate(10);

        $body = [];
        foreach ($items as $item) {
            $body[] = new TableRowDto([
                $item->id,
                $item->title,
                $item->description,
                $item->active,
                $item->sort,
                new TableComponentDto('components.forms.remove-form', [
                    'url' => route('admin.price.destroy', $item->id)
                ]),
            ], route('admin.price.detail', $item->id));
        }

        $head = new TableRowDto([
            'ID',
            'Название',
            'Описание',
            'Активность',
            'Сортировка',
            'Удалить',
        ]);

        $table = new TableDto($head, $body);

        return view('admin.price.index', compact('table', 'items'));
    }

    public function destroy(Price $item)
    {
        $item->delete();

        flash()->info(__('crud.destroy.success'));

        return redirect()->route('admin.price.index');
    }

    public function pageCreate()
    {
        return view('admin.price.create');
    }

    public function create(PriceRequest $request)
    {
        $fields = $request->validated();
        $saveFields = [
            'active' => $request->has('active'),
            'title' => $fields['title'],
            'description' => $fields['description'],
            'sort' => $fields['sort'],
        ];

        Price::query()->create($saveFields);

        flash()->info(__('crud.create.success'));

        return redirect()->route('admin.price.index');
    }

    public function update(Price $item, PriceRequest $request)
    {
        $fields = $request->validated();
        $saveFields = [
            'active' => $request->has('active'),
            'title' => $fields['title'],
            'description' => $fields['description'],
            'sort' => $fields['sort'],
        ];

        $item->update($saveFields);

        flash()->info(__('crud.update.success'));

        return redirect()->back();
    }

    public function detail(Price $item)
    {
        return view('admin.price.detail', compact('item'));
    }
}
