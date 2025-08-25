<?php

namespace App\ViewModels;

class ReviewsFormViewModel extends AbstractPagesViewModel
{
    public function showForm(): bool
    {
        $time = session()->get('disallowSendReview');

        if (empty($time)) {
            return true;
        }

        return (now() > $time);
    }

    public function formMessage(): string
    {
        if (!$this->showForm()) {
            return 'Вы сможете отправить еще отзыв позже!';
        }

        return '';
    }
}
