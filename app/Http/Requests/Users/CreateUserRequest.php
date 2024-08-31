<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'login_name' => ['required', 'string', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:14', 'confirmed'],
            'phone_number' => ['required', 'numeric', 'min:9', 'unique:users'],
            'business' => ['nullable', 'string', 'max:255'],
            'balance' => ['numeric', 'min:0', 'max:99999999.99'],
            'address' => ['nullable', 'string', 'max:255'],
            'url_image' => ['nullable', 'string', 'max:255'],
        ];
    }
}
