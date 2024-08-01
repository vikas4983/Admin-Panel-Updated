<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApprovalsRequest extends FormRequest
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
            'about_me' => 'sometimes|in:0,1',
            'about_education' => 'sometimes|in:0,1',
            'about_occupation' => 'sometimes|in:0,1',
            'about_family' => 'sometimes|in:0,1',
            'read_carefully' => 'sometimes|in:0,1',
            'success_story' => 'sometimes|in:0,1',
            'image1' => 'sometimes|in:0,1',
            'image2' => 'sometimes|in:0,1',
            'image3' => 'sometimes|in:0,1',
            'image4' => 'sometimes|in:0,1',
            'image5' => 'sometimes|in:0,1',
            'image6' => 'sometimes|in:0,1',
            'status' => 'sometimes|in:0,1',
        ];
    }
}
