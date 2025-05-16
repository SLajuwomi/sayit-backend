<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;

Route::middleware('api')
  ->prefix('api') // This is the important part
  ->group(base_path('routes/api.php'));