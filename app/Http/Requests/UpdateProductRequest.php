<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'price' => 'nullable',
            'description' => 'nullable|string',
            'image' => 'nullable|image' // 2MB
        ];
    }

    // failed messages
    public function messages(): array
    {
        return [
            'name.required' => 'A name is required',
            'price.required' => 'A price is required',
            'description.required' => 'A description is required',
            'image.required' => 'An image is required',
        ];
    }
}
