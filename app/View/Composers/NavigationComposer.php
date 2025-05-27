<?php

namespace App\View\Composers;

use App\Menu\Menu;
use App\Menu\MenuItem;
use Illuminate\View\View;

class NavigationComposer
{
    public function compose(View $view): void
    {
        $menu = Menu::make()
            ->add(MenuItem::make('/test/', 'портфолио'))
            ->addIf(true, MenuItem::make('/test/', 'стоимость'))
            ->add(MenuItem::make(route('home'), 'главная'))
            ->add(MenuItem::make('/test/', 'отзывы'))
            ->add(MenuItem::make('/test/    ', 'контакты'))
        ;

        $view->with('menu', $menu);
    }
}
