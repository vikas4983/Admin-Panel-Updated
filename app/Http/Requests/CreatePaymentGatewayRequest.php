<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePaymentGatewayRequest extends FormRequest
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
    public function messages()
    {
        return [
            'name.nullable' => 'The name field is optional.',
            'razorpay_key.nullable' => 'The Razorpay key field is optional.',
            'salt.nullable' => 'The salt field is optional.',
            'merchant_id.nullable' => 'The merchant ID field is optional.',
            'merchant_key.nullable' => 'The merchant key field is optional.',
            'bank_name.nullable' => 'The bank name field is optional.',
            'account_name.nullable' => 'The account name field is optional.',
            'bank_account_number.nullable' => 'The bank account number field is optional.',
            'bank_account_type.nullable' => 'The bank account type field is optional.',
            'bank_ifsc.nullable' => 'The bank IFSC field is optional.',
            'status.nullable' => 'The status field is optional.',
        ];
    }
}
