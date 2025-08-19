<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\ViewModels\ContactsViewModel;

class ContactsController extends Controller
{
    public function page()
    {
        return (new ContactsViewModel())->view('pages.contacts');
    }
}
