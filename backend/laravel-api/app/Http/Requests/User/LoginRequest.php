<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\FailedValidationErrorRequest;

class LoginRequest extends FormRequest
{
    use FailedValidationErrorRequest;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'     => 'required|exists:users,email',
            'password'  => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'The email field is required.',
            'email.exist' => 'User not found.',
            'password.required' => 'The password field is required.',
        ];
    }
}
