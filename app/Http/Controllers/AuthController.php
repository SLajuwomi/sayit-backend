<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest; // Placeholder for Step 2.1
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Required for register method
use Illuminate\Validation\ValidationException; // Required for throwing validation exception manually

/**
 * @description
 * This controller handles user authentication processes, including registration,
 * login, and logout.
 *
 * Key features:
 * - User Registration (Placeholder for Step 2.1)
 * - User Login
 * - User Logout (To be implemented in Step 2.3)
 *
 * @dependencies
 * - App\Http\Requests\LoginRequest: For validating login data.
 * - App\Http\Requests\RegisterRequest: (Placeholder) For validating registration data.
 * - App\Models\User: Eloquent model for users.
 * - Illuminate\Support\Facades\Auth: For handling authentication.
 * - Illuminate\Support\Facades\Hash: For password hashing.
 * - Illuminate\Validation\ValidationException: For custom validation error responses.
 */
class AuthController extends Controller
{
    /**
     * Handle a login request to the application.
     *
     * @param LoginRequest $request The request object containing login credentials.
     * @return JsonResponse Returns a JSON response with the API token and user data on success,
     *                      or an error message on failure.
     * @throws ValidationException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        // Attempt to authenticate the user with the provided credentials.
        // The LoginRequest already validates that 'email' and 'password' are present.
        if (!Auth::attempt($request->only('email', 'password'))) {
            // If authentication fails, throw a ValidationException.
            // This will result in a 422 Unprocessable Entity response,
            // which is conventional for form validation errors.
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')], // 'auth.failed' is a standard Laravel localization key for "These credentials do not match our records."
            ]);
        }

        // Retrieve the authenticated user instance.
        /** @var User $user */
        $user = Auth::user();

        // Create a new Sanctum API token for the user.
        // The token name can be anything descriptive, e.g., 'auth_token'.
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return a successful JSON response with the API token and basic user information.
        return response()->json([
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'screen_name' => $user->screen_name,
                'email' => $user->email,
            ]
        ]);
    }

    /**
     * Handle a registration request to the application.
     * (This method would be fully implemented in Step 2.1)
     *
     * @param RegisterRequest $request The request object containing registration data.
     * @return JsonResponse Returns a JSON response with the API token and user data on success,
     *                      or an error message on failure.
     */
    public function register(Request $request): JsonResponse // Changed to Request for placeholder
    {
        // This is a placeholder for the registration logic from Step 2.1.
        // A typical implementation would involve:
        // 1. Validation using RegisterRequest.
        // 2. Creating a new User record.
        //    $user = User::create([
        //        'screen_name' => $request->screen_name,
        //        'email' => $request->email,
        //        'password' => Hash::make($request->password),
        //    ]);
        // 3. Generating an API token for the new user.
        //    $token = $user->createToken('auth_token')->plainTextToken;
        // 4. Returning a success response with the token and user data.
        //    return response()->json([
        //        'message' => 'Registration successful',
        //        'access_token' => $token,
        //        'token_type' => 'Bearer',
        //        'user' => [
        //            'id' => $user->id,
        //            'screen_name' => $user->screen_name,
        //            'email' => $user->email,
        //        ]
        //    ], 201);

        return response()->json(['message' => 'Register endpoint placeholder - to be implemented in Step 2.1'], 501);
    }

    /**
     * Handle a logout request to the application.
     * (This method will be implemented in Step 2.3)
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        // This is a placeholder for the logout logic from Step 2.3.
        // A typical implementation would involve:
        // 1. Getting the authenticated user.
        // 2. Revoking the current access token.
        //    $request->user()->currentAccessToken()->delete();
        // 3. Returning a success response.
        //    return response()->json(['message' => 'Successfully logged out']);

        return response()->json(['message' => 'Logout endpoint placeholder - to be implemented in Step 2.3'], 501);
    }
}