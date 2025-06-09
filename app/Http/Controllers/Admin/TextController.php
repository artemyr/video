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
    public function page(): View|Factory|Application|RedirectResponse
    {
        $texts = Text::query()
            ->orderBy('sort')
            ->get();

        $rows = [];
        foreach ($texts as $text) {
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
        ], $rows, [
            'needRemoveBtn' => true
        ]);

        return view('admin.text.index', compact('table'));
    }

    public function destroy(Text $text): View|Factory|Application|RedirectResponse
    {
        $text->delete();
        return redirect()->route('admin.text.index');
    }

    public function pageCreate(): View|Factory|Application|RedirectResponse
    {
        return view('admin.text.create');
    }

    public function create(TextRequest $request): View|Factory|Application|RedirectResponse
    {
        Text::query()->create($request->validated());

        return redirect()->route('admin.text.index');
    }

    public function update(Text $text, TextRequest $request): View|Factory|Application|RedirectResponse
    {
        $text->update($request->validated());

        return redirect()->route('admin.text.index');
    }

    public function detail($id): View|Factory|Application|RedirectResponse
    {
        $text = Text::query()
            ->where('id', $id)
            ->firstOrFail();

        return view('admin.text.detail', compact('text'));
    }
}
