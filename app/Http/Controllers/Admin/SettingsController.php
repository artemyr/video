<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Support\DTO\Table\TableComponentDto;
use Support\DTO\Table\TableDto;

class SettingsController
{
    public function page(): View|Factory|Application|RedirectResponse
    {
        $settings = Setting::query()
            ->orderBy('sort')
            ->get();

        $rows = [];
        foreach ($settings as $setting) {
            $rows[] = [
                'values' => [
                    $setting->id,
                    $setting->code,
                    $setting->sort,
                    str($setting->value)->substr(0,300),
                    $setting->description,
                    new TableComponentDto('components.forms.remove-form', [
                        'url' => route('admin.settings.destroy', $setting->id)
                    ]),
                ],
                'detailUrl' => route('admin.settings.detail', $setting->id)
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

        return view('admin.settings.index', compact('table'));
    }

    public function destroy(Setting $setting): View|Factory|Application|RedirectResponse
    {
        $setting->delete();
        return redirect()->route('admin.settings.index');
    }

    public function pageCreate(): View|Factory|Application|RedirectResponse
    {
        return view('admin.settings.create');
    }

    public function create(SettingRequest $request): View|Factory|Application|RedirectResponse
    {
        Setting::query()->create($request->validated());

        return redirect()->route('admin.settings.index');
    }

    public function update(Setting $setting, SettingRequest $request): View|Factory|Application|RedirectResponse
    {
        $setting->update($request->validated());

        return redirect()->route('admin.settings.index');
    }

    public function detail($id): View|Factory|Application|RedirectResponse
    {
        $setting = Setting::query()
            ->where('id', $id)
            ->firstOrFail();

        return view('admin.settings.detail', compact('setting'));
    }
}
