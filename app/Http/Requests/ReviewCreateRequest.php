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
            'image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'g-recaptcha-response' => [new CaptchaRule()]
        ];
    }
}
