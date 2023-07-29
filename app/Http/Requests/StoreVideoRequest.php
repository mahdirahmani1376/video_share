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
            'url' => ['required','url'],
            'slug' => ['required','unique:videos,slug','alpha_dash:'],
            'thumbnail' => ['required','url'],
            'length' => ['required','integer']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
