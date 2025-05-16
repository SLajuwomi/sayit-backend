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
*/

// Route for user registration
Route::post('/register', [AuthController::class, 'register']);

// Example route that comes with Laravel, can be removed if not needed for authenticated user fetching.
// For now, we will keep it as a placeholder for fetching authenticated user details later if needed.
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });