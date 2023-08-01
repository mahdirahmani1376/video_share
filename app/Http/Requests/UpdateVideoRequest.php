<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVideoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'url' => ['required'],
            'length' => ['nullable', 'integer'],
            'slug' => ['required','alpha_dash',Rule::unique('videos','slug')->ignore($this->video)],
            'description' => ['nullable'],
            'thumbnail' => ['required'],
            'category_id' => ['nullable','integer']
        ];
    }
}
