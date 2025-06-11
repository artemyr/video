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
    public function page()
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

    public function destroy(Setting $setting)
    {
        $setting->delete();
        return redirect()->route('admin.settings.index');
    }

    public function pageCreate()
    {
        return view('admin.settings.create');
    }

    public function create(SettingRequest $request)
    {
        Setting::query()->create($request->validated());

        return redirect()->route('admin.settings.index');
    }

    public function update(Setting $setting, SettingRequest $request)
    {
        $setting->update($request->validated());

        return redirect()->route('admin.settings.index');
    }

    public function detail(Setting $setting)
    {
        return view('admin.settings.detail', compact('setting'));
    }
}
