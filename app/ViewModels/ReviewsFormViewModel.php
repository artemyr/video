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
            return 'Спасибо за отзыв! Вы сможете поделиться новым мнением чуть позже.';
        }

        return '';
    }

    public function fileInputLabel(): string
    {
        return str(config('forms.review.mimes'))
            ->upper()
            ->replace(',', ', ')
            ->value() . ' до ' . config('forms.review.max_size') / 1024 . ' MB';
    }
}
