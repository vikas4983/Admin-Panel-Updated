<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteSettingRequest extends FormRequest
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
            'name' => ['sometimes', 'required', 'string', 'max:50'],
            'title' => ['sometimes', 'required', 'string', 'max:50'],
            'description' => ['sometimes', 'required', 'string', 'max:500'],
            'number' => ['sometimes', 'required', 'string', 'max:13', 'min:10'],
            'email' => ['sometimes', 'required', 'string', 'max:50'],
            'google_analytics_code' => ['sometimes', 'required', 'string', 'max:50'],
            'footer' => ['sometimes', 'required', 'string', 'max:100'],
            'watermark' => ['sometimes', 'required', 'string', 'max:100'],
        ];
    }
}
