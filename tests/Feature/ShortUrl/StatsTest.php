<?php

namespace Tests\Feature\ShortUrl;

use App\Models\ShortUrl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class StatsTest extends TestCase
{
    /** @test */
    public function it_should_return_the_last_visit_on_the_short_url()
    {
        $shortUrl = ShortUrl::factory()->createOne();
        $this->get($shortUrl->code);

        $this->getJson(route('api.short-url.stats.last-visit', $shortUrl->code))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'last_visit' => $shortUrl->last_visit?->toIso8601String(),
            ]);

        $this->assertDatabaseHas('visits', [
            'short_url_id' => $shortUrl->id,
            'created_at' => Carbon::now(),
        ]);
    }

    /** @test */
    public function it_should_return_the_amount_per_day_of_visits_with_a_total()
    {
        $shortUrl = ShortUrl::factory()->createOne();
        $this->get($shortUrl->code);
        $this->get($shortUrl->code);
        $this->get($shortUrl->code);

        $this->getJson(route('api.short-url.stats.visits', $shortUrl->code))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'total' => 3,
                'visits' => [
                    [
                        'date' => Carbon::now()->format('Y-m-d'),
                        'amount' => 3,
                    ],
                ],
            ]);

        $this->assertDatabaseCount('visits', 3);
    }
}