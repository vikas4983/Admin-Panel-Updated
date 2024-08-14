<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmailSettingRequest extends FormRequest
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
            'host' => 'required|string|max:50',
            'email' => 'required|email|unique:email_settings,email',
            'port' => 'required|integer|min:1|max:65535',
            'password' => 'required|min:6|max:16',
            'status' => 'required|in:0,1',
        ];
    }
}
