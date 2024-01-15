<?php

use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;

#region Short URL
Route::post('/short-urls', [ShortUrlController::class, 'store'])->name('api.short-url.store');
Route::delete('/short-urls/{code}', [ShortUrlController::class, 'destroy'])->name('api.short-url.destroy');
#endregion

#region Statistics
Route::get('/short-urls/{code}/stats/last-visit', [StatsController::class, 'lastVisit'])->name('api.short-url.stats.last-visit');
Route::get('/short-urls/{code}/stats/visits', [StatsController::class, 'visits'])->name('api.short-url.stats.visits');
#endregion