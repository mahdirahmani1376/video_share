<?php

namespace App\Http\Requests;

use App\Models\Comment;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create',[Comment::class,$this->video]);
    }
    public function rules(): array
    {
        return [
            'text' => ['required'],
        ];
    }
}
