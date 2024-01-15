<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Carbon\Carbon;

class StatsController extends Controller
{
    public function lastVisit($code)
    {
        $shortUrl = ShortUrl::whereCode($code)->firstOrFail();
        return [
            'last_visit' => $shortUrl->last_visit?->toIso8601String(),
        ];
    }

    public function visits($code)
    {
        $shortUrl = ShortUrl::whereCode($code)->firstOrFail();
        return [
            'total' => $shortUrl->visits()->count(),
            'visits' => [
                [
                    'date' => Carbon::now()->format('Y-m-d'),
                    'amount' => $shortUrl->visits()->count(),
                ],
            ]
        ];
    }
}
