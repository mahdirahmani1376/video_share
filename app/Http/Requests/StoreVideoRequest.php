<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreVideoRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
           'slug' => Str::slug($this->slug),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'file' => ['required','file','mimetypes:video/mp4'],
            'slug' => ['required','unique:videos,slug','alpha_dash'],
            'category_id' => ['nullable','integer']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
