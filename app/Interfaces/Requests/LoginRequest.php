<?php

namespace App\Interfaces\Requests;


class LoginRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|string|exists:users,username|min:3|max:255',
            'password' => 'required|string|min:6',
        ];
    }
}
