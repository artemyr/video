<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class AdminController
{
    public function page(): Application|Factory|View
    {
        return view('admin.index');
    }
}
