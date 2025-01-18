<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperationRequst extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category' => ['required', 'max:50'],
            'description' => ['required', 'min:3', 'max:255'],
            'phone_namber' => ['required', 'max:10'],
            'price' => ['numeric', 'min:1', 'max:10000'],
            'service_name' => ['required', 'max:255'],
            'status' => ['required',  'max:255'],
            'readiness' => ['required',  'max:255'],
            'token' => ['required', 'max:500'],
            'trans_id' => ['required', 'unique:operations,trans_id'],
            'date_added' => ['required', 'date'],
        ];
    }
}
