<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * For registration, typically any guest user is authorized to attempt.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * These rules are based on the project specification for user registration:
     * - Email: Required, valid email format, unique in the users table.
     * - Screen Name: Required, unique in the users table.
     * - Password: Required, minimum length, must be confirmed.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'screen_name' => ['required', 'string', 'max:255', 'unique:users,screen_name'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'string',
                Password::min(8), // Enforces a minimum of 8 characters for the password.
                                  // Consider adding ->mixedCase()->numbers()->symbols()->uncompromised() for stronger passwords.
                'confirmed', // Requires a 'password_confirmation' field in the request that matches 'password'.
            ],
        ];
    }
}