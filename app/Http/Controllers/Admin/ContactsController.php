<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ContactsRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Support\Enums\SettingsEnum;

class ContactsController
{
    public function page()
    {
        $image = '';

        $s = Setting::query()
            ->where('code', SettingsEnum::CONTACTS_LOGO->value)
            ->first();

        if (!empty($s)) {
            $image = asset('storage/images/' . $s->value);
        }

        return view('admin.contacts.index', compact('image'));
    }

    public function handle(ContactsRequest $request)
    {
        $storageImages = Storage::disk('images');

        $s = Setting::query()
            ->where('code', SettingsEnum::CONTACTS_LOGO->value)
            ->first();

        if ($request->has('logo')) {
            if (!empty($s->value)) {
                if ($storageImages->exists($s->value)) {
                    $storageImages->delete($s->value);
                }
            }
        }

        $logoPath =$storageImages
            ->put('contacts/logo', $request->file('logo'));

        Setting::query()->updateOrCreate([
            'code' => SettingsEnum::CONTACTS_LOGO->value
        ],[
            'value' => $logoPath
        ]);

        return redirect(route('admin.contacts.index'));
    }
}
