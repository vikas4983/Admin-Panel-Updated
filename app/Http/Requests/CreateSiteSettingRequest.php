<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSiteSettingRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50'],
            'title' => ['required', 'string', 'max:1000'],
            'description' => ['required', 'string', 'max:1000'],
            'number' => ['required', 'string', 'max:13', 'min:10'],
            'email' => ['required', 'string', 'max:50'],
            'google_analytics_code' => ['required', 'string', 'max:50'],
            'footer' => ['required', 'string', 'max:1000'],
           // 'watermark' => ['required', 'string', 'max:100'],
        ];
    }
}
