<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'url' => ['required','url'],
            'slug' => ['required','unique:videos,slug'],
            'thumbnail' => ['required','url'],
            'length' => ['required','integer']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
