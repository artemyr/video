<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class CaptchaRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $result = Http::get(config('captcha.check_url'), [
            'secret' => config('captcha.secret'),
            'response' => $value,
            'remoteip' => request()->ip(),
        ])->json();

        if (!$result['success']) {
            $fail('Captcha validation failed.');
        }
    }
}
