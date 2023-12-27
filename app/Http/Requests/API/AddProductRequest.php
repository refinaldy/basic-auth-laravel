<?php

namespace App\Http\Requests\API;

use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
            'name' => 'required|string|max:255',
            'price' => 'required',
            'description' => 'required|string',
        ];
    }

    // failed messages
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required',
            'name.string' => 'The name field must be a string',
            'name.max' => 'The name field must be less than 255 characters',
            'price.required' => 'The price field is required',
            'description.required' => 'The description field is required',
            'description.string' => 'The description field must be a string',
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($validator->errors()->count() > 0) {
                    return response()->json([
                        'status' => 'error',
                        'message' => $validator,
                    ])->setStatusCode(422);
                }
            }
        ];
    }
}
