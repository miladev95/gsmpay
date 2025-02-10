<?php

namespace App\Interfaces\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'text' => 'required|string|min:10',
        ];
    }
}
