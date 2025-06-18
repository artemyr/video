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
            ->add(MenuItem::make(route('admin.text.index'), 'Текста'))
            ->add(MenuItem::make(route('admin.main.slider.index'), 'Главная - слайдер'))
            ->add(MenuItem::make(route('admin.settings.index'), 'Настройки'))
            ->add(MenuItem::make(route('admin.portfolio.index'), 'Портфолио'))
            ->add(MenuItem::make(route('admin.price.index'), 'Стоимость'))
            ->add(MenuItem::make(route('admin.review.index'), 'Отзывы'))
            ->add(MenuItem::make(route('admin.main.index'), 'Главная'))
            ->add(MenuItem::make(route('admin.contacts.index'), 'Контакты'))
        ;

        $view->with('adminMenu', $menu);
    }
}
