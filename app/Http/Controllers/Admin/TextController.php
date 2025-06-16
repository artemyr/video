<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TextRequest;
use App\Models\Text;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Support\DTO\Table\TableComponentDto;
use Support\DTO\Table\TableDto;

class TextController
{
    public function index()
    {
        $items = Text::query()
            ->sorted()
            ->paginate(10);

        $rows = [];
        foreach ($items as $text) {
            $rows[] = [
                'values' => [
                    $text->id,
                    $text->code,
                    $text->sort,
                    str($text->text)->substr(0,300),
                    $text->description,
                    new TableComponentDto('components.forms.remove-form', [
                        'url' => route('admin.text.destroy', $text->id)
                    ]),
                ],
                'detailUrl' => route('admin.text.detail', $text->id)
            ];
        }

        $table = TableDto::make([
            'ID',
            'Код',
            'Сортировка',
            'Текст',
            'Описание',
            'Удалить',
        ], $rows);

        return view('admin.text.index', compact('table','items'));
    }

    public function destroy(Text $text)
    {
        $text->delete();

        flash()->info(__('crud.destroy.success'));

        return redirect()->route('admin.text.index');
    }

    public function pageCreate()
    {
        return view('admin.text.create');
    }

    public function create(TextRequest $request)
    {
        Text::query()->create($request->validated());

        flash()->info(__('crud.create.success'));

        return redirect()->route('admin.text.index');
    }

    public function update(Text $text, TextRequest $request)
    {
        $text->update($request->validated());

        flash()->info(__('crud.update.success'));

        return redirect()->route('admin.text.index');
    }

    public function detail(Text $item)
    {
        return view('admin.text.detail', compact('item'));
    }
}
