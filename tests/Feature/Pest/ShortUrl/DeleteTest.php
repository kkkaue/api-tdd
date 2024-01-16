<?php

use App\Models\ShortUrl;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\deleteJson;

it('should be able to delete a short url', function () {
  $shortUrl = ShortUrl::factory()->create();

  deleteJson(route('api.short-url.destroy', $shortUrl->code))
    ->assertStatus(Response::HTTP_NO_CONTENT);

  $this->assertDatabaseMissing('short_urls', [
    'id' => $shortUrl->id,
  ]);
});
