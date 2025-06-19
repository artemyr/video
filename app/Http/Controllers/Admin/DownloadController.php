<?php

namespace App\Http\Controllers\Admin;

use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController
{
    public function store(Request $request)
    {
        $path = Storage::disk('video')
            ->put('slider', $request->file('file'));

        $download = Download::create([
            'title'=> $request->get('title'),
            'path' => $path,
            'mime' => $request->file('file')->getMimeType(),
            'size' => $request->file('file')->getSize(),
        ]);

        return $download->id;
    }

    public function update(Request $request, Download $download)
    {
        //
    }

    public function destroy(Download $download)
    {
        if(! Storage::disk('video')->delete($download->path)) {
            flash()->alert('Delete error');
            return back();
        }

        if ($download->delete()) {
            return back();
        }
    }
}
