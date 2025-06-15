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
            ->add(MenuItem::make(route('admin.text.index'), 'Текста'))
            ->add(MenuItem::make(route('admin.main'), 'Главная'))
            ->add(MenuItem::make(route('admin.settings.index'), 'Настройки'))
            ->add(MenuItem::make(route('admin.portfolio.index'), 'Портфолио'))
//            ->add(MenuItem::make(route(''), 'стоимость'))
//            ->add(MenuItem::make(route(''), 'отзывы'))
//            ->add(MenuItem::make(route(''), 'контакты'))
        ;

        $view->with('adminMenu', $menu);
    }
}
