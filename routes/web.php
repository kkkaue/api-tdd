<?php

use App\Models\ShortUrl;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('{code}', function ($code) {
    $shortUrl = ShortUrl::where('code', $code)->firstOrFail();

    $shortUrl->visits()->create([
        'ip_address' => request()->ip(),
        'user_agent' => request()->userAgent(),
    ]);
    
    return ['laravel' => app()->version()];
});

require __DIR__.'/auth.php';
