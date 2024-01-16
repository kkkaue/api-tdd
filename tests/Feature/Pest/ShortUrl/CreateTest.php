<?php

use Symfony\Component\HttpFoundation\Response;
use Facades\App\Actions\CodeGenerator;
use App\Models\ShortUrl;
use Illuminate\Support\Str;

use function Pest\Laravel\postJson;

it('should be able to create a short url', function () {
  $randomCode = Str::random(5);

  CodeGenerator::shouldReceive('run')
    ->once()
    ->andReturn($randomCode);

  postJson(route('api.short-url.store'), ['url' => 'https://www.google.com'])
    ->assertStatus(Response::HTTP_CREATED)
    ->assertJson([
      'shortUrl' => config('app.url') . '/' . $randomCode,
    ]);

  $this->assertDatabaseHas('short_urls', [
    'url' => 'https://www.google.com',
    'short_url' => config('app.url') . '/' . $randomCode,
    'code' => $randomCode,
  ]);
});

test('url should be valid', function () {
  $this->postJson(route('api.short-url.store'), ['url' => 'invalid-url'])
    ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
    ->assertJsonValidationErrors([
      'url' => __('validation.url', ['attribute' => 'url']),
    ]);
});

it('should return the existed code if the url is the same', function () {
  ShortUrl::factory()->create([
    'url' => 'https://www.google.com',
    'short_url' => config('app.url') . '/123456',
    'code' => '123456',
  ]);

  postJson(route('api.short-url.store'), ['url' => 'https://www.google.com'])
    ->assertJson([
      'shortUrl' => config('app.url') . '/123456',
    ]);

  $this->assertDatabaseCount('short_urls', 1);
});