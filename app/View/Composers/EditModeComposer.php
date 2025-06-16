<?php

namespace App\View\Composers;

use Illuminate\View\View;

class EditModeComposer
{
    private static $isEditMode = null;

    public function compose(View $view): void
    {
        if (self::$isEditMode === null) {
            $this->getEditMode();
        }

        $view->with('editMode', self::$isEditMode);
    }

    private function getEditMode(): void
    {
        $editMode = false;
        $session = session();
        if (request('edit') === 'y' && auth()->id() > 0 && auth()->user()->role === 'admin') {
            $session->put('editMode', true);
        }
        if (request('edit') === 'n' && auth()->id() > 0 && auth()->user()->role === 'admin') {
            $session->put('editMode', false);
        }
        if (auth()->id() > 0 && auth()->user()->role === 'admin' && $session->get('editMode') === true) {
            $editMode = true;
        }
        self::$isEditMode = $editMode;
    }
}
