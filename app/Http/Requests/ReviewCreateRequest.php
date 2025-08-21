<?php

namespace App\Http\Requests;

use App\Rules\CaptchaRule;
use Illuminate\Foundation\Http\FormRequest;

class ReviewCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'g-recaptcha-response' => [new CaptchaRule()]
        ];
    }
}
