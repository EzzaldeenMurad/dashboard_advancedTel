<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'login_name' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'min:8', 'max:14'],
        ];
    }
}
