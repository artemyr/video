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
            ->add(MenuItem::make(route('portfolio.page'), 'портфолио'))
            ->add(MenuItem::make(route('price.page'), 'стоимость'))
            ->add(MenuItem::make(route('home'), 'главная'))
            ->add(MenuItem::make(route('reviews.page'), 'отзывы'))
            ->add(MenuItem::make(route('contacts.page'), 'контакты'))
            ->addIf(
                auth()->id() > 0 && auth()->user()->role,
                MenuItem::make(route('admin.index'), 'админка')
            )
        ;

        $view->with('menu', $menu);
    }
}
