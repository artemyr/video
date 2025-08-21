<?php

return [
    'js_url' => 'https://www.google.com/recaptcha/api.js',
    'check_url' => 'https://www.google.com/recaptcha/api/siteverify',
    'key' => env('GOOGLE_RECAPTCHA_KEY'),
    'secret' => env('GOOGLE_RECAPTCHA_SECRET'),
];
