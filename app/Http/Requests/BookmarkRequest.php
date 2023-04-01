<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookmarkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'url' => ['required'],
            'description' => ['nullable'],
            'status' => ['nullable', 'integer'],
            'image' => ['nullable'],
        ];
    }
}
