<?php

namespace App\Http\Requests\Offers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferRequst extends FormRequest
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
            'offer_name' => ['required',  'max:100'],
            'offer_type' => ['required', 'max:50'],
            'company_name' => ['required', 'max:50'],
            'price' => ['required', 'numeric', 'min:1', 'max:100000'],
            'offer_code' => ['required', 'max:50'],
            'subscription_type' => ['nullable', 'max:255'],
            'payment_type' => ['nullable', 'max:50'],
        ];
    }
}
