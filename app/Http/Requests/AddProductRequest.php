<?php

namespace App\Http\Requests;

use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseIsRedirected;

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
            'images' => 'required|array', // 10MB
            'images.*' => 'image|mimes:jpg,png|max:10240',
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
            'image.required' => 'The image field is required',
            'image.image' => 'The image field must be an image',
            'image.mimetypes' => 'The image field must be a jpg or png',
            'image.max' => 'The image field must be less than 10MB',
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($validator->errors()->count() > 0) {
                    return redirect()->back()->withErrors($validator->errors());
                }
            }
        ];
    }

}
