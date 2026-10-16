<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Public site and admin UI are served by the Next.js frontend.
| Laravel remains the API + Sanctum backend.
|
*/

Route::redirect('/', config('app.frontend_url'));
