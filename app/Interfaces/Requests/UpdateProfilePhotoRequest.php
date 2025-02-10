<?php

namespace App\Interfaces\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilePhotoRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'profile_photo' => 'required|image|max:2048',
        ];
    }
}
