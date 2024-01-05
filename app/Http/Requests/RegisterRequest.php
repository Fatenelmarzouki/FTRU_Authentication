<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string',
            "email" => "required|email|unique:users,email",
            "password" => "required|min:10|confirmed",
        ];

    }


    public function messages()
    {
        return [
            'name.required' => "The Name is required.",
            'email.required' => 'The Email is required.',
            'email.unique' => 'This Email is already Exist',
            'password.required' => 'The Password is required.',
            'password.confirmed' => 'Have you forgotten your password already ?!!',
            'password.min' => 'The Password must greater than 10 character',
        ];
    }

}