<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteConfigRequest extends FormRequest
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
        $rules = [
            'interest_setting' => 'required|in:0,1',
            'profile_view_setting' => 'required|in:0,1',
            'profile_name_setting' => 'required|in:0,1,2',
            'profile_activation' => 'required|in:0,1',
            'profile_photo_setting' => 'required|in:0,1',
            'profile_kyc_setting' => 'required|in:0,1',
            'success_story_year_setting' => 'required|integer|min:1900|max:' . date('Y'),
            'male_legal_age' => 'required|integer|min:18|max:120',
            'female_legal_age' => 'required|integer|min:18|max:120',
            'status' => 'required|in:0,1',
        ];

        // Add 'sometimes' rule to all fields
        foreach ($rules as $key => $rule) {
            $rules[$key] = 'sometimes|' . $rule;
        }

        return $rules;
    }
}
