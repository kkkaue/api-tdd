<?php

namespace Tests\Feature\ShortUrl;

use App\Models\ShortUrl;
use Facades\App\Actions\CodeGenerator;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Support\Str;

class CreateTest extends TestCase
{
  /** @test */
  public function it_should_be_able_to_create_a_short_url()
  {
    
    $randomCode = Str::random(5);

    CodeGenerator::shouldReceive('run')
      ->once()
      ->andReturn($randomCode);

    $this->postJson(route('api.short-url.store'), ['url' => 'https://www.google.com'])
      ->assertStatus(Response::HTTP_CREATED)
      ->assertJson([
        'shortUrl' => config('app.url') . '/' . $randomCode,
      ]);

    $this->assertDatabaseHas('short_urls', [
      'url' => 'https://www.google.com',
      'short_url' => config('app.url') . '/' . $randomCode,
      'code' => $randomCode,
    ]);
  }

  /** @test */
  public function it_should_be_valid_url()
  {
    $this->postJson(route('api.short-url.store'), ['url' => 'invalid-url'])
      ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
      ->assertJsonValidationErrors([
        'url' => __('validation.url', ['attribute' => 'url']),
      ]);
  }

  /** @test */
  public function it_should_return_the_existed_code_if_the_url_is_the_same()
  {
    ShortUrl::factory()->create([
      'url' => 'https://www.google.com',
      'short_url' => config('app.url') . '/123456',
      'code' => '123456',
    ]);

    $this->postJson(route('api.short-url.store'), ['url' => 'https://www.google.com'])
      ->assertJson([
        'shortUrl' => config('app.url') . '/123456',
      ]);

    $this->assertDatabaseCount('short_urls', 1);
  }
  /** @test */
  /* public function it_should_generate_unique_codes()
  {
    $codes = [];

    for ($i = 0; $i < 10000; $i++) {
      $code = CodeGenerator::run();
      $this->assertNotContains($code, $codes);
      $codes[] = $code;
    }
  } */
}
