<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @description
 * Form request for validating user login data.
 *
 * This class defines the validation rules that apply to the data
 * submitted when a user attempts to log in.
 *
 * @property string $email The user's email address.
 * @property string $password The user's password.
 *
 * @notes
 * - The 'email' field checks for existence in the 'users' table, which is a common
 *   practice but can be debated from a security perspective (revealing if an email is registered).
 *   For this application, it's kept as per typical Laravel scaffolding.
 */
class LoginRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * Authorization for login is typically handled by the Auth facade in the controller.
   * This method can be used for other authorization checks if needed.
   *
   * @return bool True if the user is authorized, false otherwise.
   */
  public function authorize(): bool
  {
    // Anyone can attempt to log in, so this is true.
    // Authorization of the actual login attempt is handled by Auth::attempt().
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * These rules ensure that the email and password fields are present and
   * meet basic format requirements.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   *         An array of validation rules.
   */
  public function rules(): array
  {
    return [
      'email' => [
        'required',         // Email field is mandatory.
        'string',           // Must be a string.
        'email',            // Must be a valid email format.
        // 'exists:users,email' // Ensures the email is registered. This can be debated for security (user enumeration).
        // For now, we'll rely on Auth::attempt to implicitly check this.
        // If we want a specific "email not found" message before checking password, this could be used.
        // However, 'auth.failed' is more generic and secure.
      ],
      'password' => [
        'required',         // Password field is mandatory.
        'string',           // Must be a string.
      ],
    ];
  }

  /**
   * Get custom messages for validator errors.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      'email.required' => 'The email field is required.',
      'email.email' => 'Please provide a valid email address.',
      // 'email.exists' => 'These credentials do not match our records.', // Example if 'exists' rule was used
      'password.required' => 'The password field is required.',
    ];
  }
}