<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSuccessStoryRequest extends FormRequest
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
            'wedding_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'groom_name' => 'sometimes|string|max:255',
            'bride_name' => 'sometimes|string|max:255',
            'wedding_date' => 'sometimes|date|after_or_equal:today',
            'description' => 'sometimes|string',
            'status' => 'sometimes|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'wedding_image.image' => 'The file must be an image.',
            'wedding_image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'wedding_image.max' => 'The image may not be greater than 2MB.',
            'groom_name.string' => 'The groom name must be a string.',
            'groom_name.max' => 'The groom name may not be greater than 255 characters.',
            'bride_name.string' => 'The bride name must be a string.',
            'bride_name.max' => 'The bride name may not be greater than 255 characters.',
            'wedding_date.date' => 'The wedding date must be a valid date.',
            'wedding_date.after_or_equal' => 'The wedding date must be a date greater or equal to today.',
            'description.string' => 'The description must be a string.',
            'description.status' => 'The status must be a integer.',
        ];
    }
}
