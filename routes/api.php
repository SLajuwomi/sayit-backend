<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
| Note: In Laravel 11+, API routes are typically defined here and loaded
| via bootstrap/app.php, with the 'api' prefix also configured there.
|
*/

// Route to get the authenticated user (example of a protected route, useful for testing tokens)
// This route will require authentication via Sanctum.
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

// Authentication Routes
// These routes handle user registration, login, and eventually logout.
// They are typically public, as users need to access them before being authenticated.

// User Registration Endpoint (from Step 2.1)
// POST /api/register
Route::post('/register', [AuthController::class, 'register']);

// User Login Endpoint (Current Step 2.2)
// POST /api/login
Route::post('/login', [AuthController::class, 'login']);

// User Logout Endpoint (To be implemented in Step 2.3)
// This route will be protected by 'auth:sanctum' middleware.
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// Future routes for topics, messages, etc., will be added below,
// likely within an `auth:sanctum` middleware group if they require authentication.