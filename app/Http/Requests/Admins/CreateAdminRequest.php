<?php

namespace App\Http\Requests\Admins;


use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'login_name' => ['required', 'string', 'max:50', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'max:14'],  // 'confirmed'
            'phone_number' => ['required', 'numeric', 'min:9', 'unique:admins'],
            'url_image' => ['nullable', 'string', 'max:255'],
            'balance' => ['numeric', 'min:0'],
            // 'role' => ['required', 'max :255'],
            // 'status' => ['required','in:1,0'],
        ];
    }
}
