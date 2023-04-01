<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'topic_id' => ['nullable', 'integer'],
            'status' => ['nullable', 'integer'],
        ];
    }
}
