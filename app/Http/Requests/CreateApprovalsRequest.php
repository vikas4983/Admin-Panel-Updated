<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateApprovalsRequest extends FormRequest
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
            
            'about_me' => 'required|in:0,1',
            'about_education' => 'required|in:0,1',
            'about_occupation' => 'required|in:0,1',
            'about_family' => 'required|in:0,1',
            'read_carefully' => 'required|in:0,1',
            'success_story' => 'required|in:0,1',
            'image1' => 'required|in:0,1',
            'image2' => 'required|in:0,1',
            'image3' => 'required|in:0,1',
            'image4' => 'required|in:0,1',
            'image5' => 'required|in:0,1',
            'image6' => 'required|in:0,1',
            'status' => 'required|in:0,1',
        ];
    }
}
