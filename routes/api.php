<?php

use App\Http\Controllers\ShortUrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/short-urls', [ShortUrlController::class, 'store'])->name('api.short-url.store');