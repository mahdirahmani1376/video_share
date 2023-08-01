<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'description' => ['nullable'],
            'slug' => ['required'],
            'icon' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
