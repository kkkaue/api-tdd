<?php

namespace App\Http\Controllers;

use Facades\App\Actions\CodeGenerator;
use App\Models\ShortUrl;
use Symfony\Component\HttpFoundation\Response;

class ShortUrlController extends Controller
{
    public function store()
    {
        $url = request('url');
        $code = CodeGenerator::run();

        $shortUrl = ShortUrl::query()
            ->create([
                'url' => $url,
                'short_url' => config('app.url') . '/' . $code,
                'code' => $code,
            ]);

        return response()->json([
            'shortUrl' => $shortUrl->short_url,
        ], Response::HTTP_CREATED);
    }
}
