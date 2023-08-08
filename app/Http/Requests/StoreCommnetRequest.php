<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommnetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'text' => ['required'],
        ];
    }
}
