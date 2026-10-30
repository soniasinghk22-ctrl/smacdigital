<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PublicApiController;

/*
|--------------------------------------------------------------------------
| Public API Routes for SMAC Digital React Frontend
|--------------------------------------------------------------------------
*/

Route::get('/site-settings', [PublicApiController::class, 'getSettings']);
Route::get('/services', [PublicApiController::class, 'getServices']);
Route::get('/services/{slug}', [PublicApiController::class, 'getService']);
Route::get('/blogs', [PublicApiController::class, 'getBlogs']);
Route::get('/blogs/{slug}', [PublicApiController::class, 'getBlog']);
Route::get('/testimonials', [PublicApiController::class, 'getTestimonials']);
Route::get('/portfolios', function () {
    return (new PublicApiController())->getServices(); // Or portfolio helper
});
Route::post('/leads/submit', [PublicApiController::class, 'submitLead']);
