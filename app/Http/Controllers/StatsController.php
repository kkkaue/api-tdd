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
        $visits = $shortUrl->visits()
            ->selectRaw('DATE(created_at) as date, COUNT(*) as amount')
            ->groupBy('date')
            ->get();
        return [
            'total' => $shortUrl->visits()->count(),
            'visits' => $visits
        ];
    }
}
