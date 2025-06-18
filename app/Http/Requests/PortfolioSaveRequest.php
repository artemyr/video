<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'string|required',
            'sort' => 'integer|required',
            'active' => 'boolean|nullable',
            'image' => 'file|required',
            'video' => 'file|nullable',
            'link' => 'string|nullable',
            'size' => 'string|nullable',
        ];
    }
}
