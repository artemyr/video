<?php

namespace App\Http\Requests;

use App\Rules\CaptchaRule;
use Illuminate\Foundation\Http\FormRequest;

class ReviewCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => [
                'file',
                'image',
                'mimes:' . config('forms.review.mimes', 'jpeg,png,jpg'),
                'max:' . config('forms.review.max_size', 2048)
            ],
            'g-recaptcha-response' => ['required', new CaptchaRule()]
        ];
    }
}
