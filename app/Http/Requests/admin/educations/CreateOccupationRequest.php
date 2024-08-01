<?php

namespace App\Http\Requests\admin\educations;

use Illuminate\Foundation\Http\FormRequest;

class CreateOccupationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'employee_id' => ['required', 'integer'],
            'occupation' => ['required', 'string'],
            'status' => ['required', 'integer'],
        ];
    }
}
