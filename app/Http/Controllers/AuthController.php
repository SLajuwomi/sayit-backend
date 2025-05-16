<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request; // Keep for potential future use, though not directly used in register
use Illuminate\Support\Facades\Hash; // Keep for potential future use, though User model handles hashing
use Illuminate\Support\Facades\Log; // For logging errors
use Exception; // For catching generic exceptions

class AuthController extends Controller
{
    /**
     * Handle a user registration request.
     *
     * This method validates the incoming registration data, creates a new user,
     * generates an API token for the user, and returns the token along with
     * the user's information.
     *
     * @param RegisterRequest $request The request object containing validated registration data.
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            // Retrieve validated data from the request.
            // The password will be automatically hashed by the User model's mutator/cast.
            $validatedData = $request->validated();

            // Create the new user.
            $user = User::create([
                'screen_name' => $validatedData['screen_name'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'], // Password hashing is handled by the User model
            ]);

            // Generate an API token for the new user.
            // The token name 'api-token' is arbitrary but descriptive.
            $token = $user->createToken('api-token')->plainTextToken;

            // Return a successful response with the token and user data.
            // HTTP 201 Created is appropriate for successful resource creation.
            return response()->json([
                'message' => 'User registered successfully.',
                'user' => new UserResource($user),
                'token' => $token,
                'token_type' => 'Bearer',
            ], 201);

        } catch (Exception $e) {
            // Log the exception for debugging purposes.
            Log::error('User registration failed: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            // Return a generic error response.
            return response()->json([
                'message' => 'An unexpected error occurred during registration. Please try again later.',
                'error' => $e->getMessage() // Optionally include error message in dev, remove for prod
            ], 500);
        }
    }
}