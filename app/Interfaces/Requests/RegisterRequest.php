<?php

namespace App\Interfaces\Requests;


class RegisterRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|string|unique:users|min:3|max:255',
            'password' => 'required|string|min:6',
            'profile_photo' => 'nullable|image|max:2048',
        ];
    }
}
