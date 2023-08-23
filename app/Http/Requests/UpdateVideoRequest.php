<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateVideoRequest extends FormRequest
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
            'file' => ['nullable','file','mimetypes:video/mp4'],
            'slug' => ['required','alpha_dash',Rule::unique('videos','slug')->ignore($this->video)],
            'description' => ['nullable'],
            'category_id' => ['nullable','integer']
        ];
    }
}
