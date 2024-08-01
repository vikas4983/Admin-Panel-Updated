<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmailSettingRequest extends FormRequest
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
            'host' => 'sometimes|required|string|max:50',
            'email' => 'sometimes|required|email|unique:users,email',
            'port' => 'sometimes|required|integer|min:1|max:65535',
            'password' => 'sometimes|required|min:6|max:255',
            'status' => 'required|in:0,1',
        ];
        
    }
}
