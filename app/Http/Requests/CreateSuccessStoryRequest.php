<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSuccessStoryRequest extends FormRequest
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
            'wedding_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'groom_name' => 'required|string|max:255',
            'bride_name' => 'required|string|max:255',
            'wedding_date' => 'required|date|after_or_equal:today',
            'description' => 'required|string',
            'status' => 'required|in:0,1',
        ];
    }
    public function messages()
    {
        return [
            'wedding_image.required' => 'The wedding image is required.',
            'wedding_image.image' => 'The file must be an image.',
            'wedding_image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'wedding_image.max' => 'The image may not be greater than 2MB.',
            'groom_name.required' => 'The groom name is required.',
            'bride_name.required' => 'The bride name is required.',
            'wedding_date.required' => 'The wedding date is required.',
            'wedding_date.date' => 'The wedding date must be a valid date.',
            'wedding_date.after_or_equal' => 'The wedding date must be a date greater or equal to today.',
        ];
    }
}
