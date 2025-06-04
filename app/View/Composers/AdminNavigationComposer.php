<?php

namespace App\View\Composers;

use App\Menu\Menu;
use App\Menu\MenuItem;
use Illuminate\View\View;

class AdminNavigationComposer
{
    public function compose(View $view): void
    {
        $menu = Menu::make()
            ->add(MenuItem::make(route('admin.media.index'), 'Медиатека'))
            ->add(MenuItem::make(route('admin.text'), 'Текста'))
            ->add(MenuItem::make(route('admin.main'), 'Главная'))
//            ->add(MenuItem::make(route(''), 'портфолио'))
//            ->add(MenuItem::make(route(''), 'стоимость'))
//            ->add(MenuItem::make(route(''), 'отзывы'))
//            ->add(MenuItem::make(route(''), 'контакты'))
        ;

        $view->with('adminMenu', $menu);
    }
}
