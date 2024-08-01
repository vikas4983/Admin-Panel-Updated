<?php

namespace App\Http\Requests\admin\countries;

use Illuminate\Foundation\Http\FormRequest;

class CreateStateRequest extends FormRequest
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
            'country_id' => ['required', 'integer', 'max:10'],
            'state' => ['required', 'string', 'max:255'],
            'status' => ['required', 'integer', 'max:10']
        ];
    }
}
