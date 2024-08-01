<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentGatewayRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'razorpay_key' => 'nullable|string|max:255',
            'salt' => 'nullable|string|max:255',
            'merchant_id' => 'nullable|string|max:255',
            'merchant_key' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:255',
            'bank_account_type' => 'nullable|string|max:50',
            'bank_ifsc' => 'nullable|string|max:11',
            'status' => 'nullable|boolean',
        ];
    }
}
