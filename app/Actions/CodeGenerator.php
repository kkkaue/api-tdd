<?php

namespace App\Actions;

use App\Models\GeneratedCode;
use Illuminate\Support\Str;

class CodeGenerator
{
  public static function run(): string
  {
    do {
      $code = Str::random(5);
    } while (GeneratedCode::where('code', $code)->exists());

    GeneratedCode::create(['code' => $code]);

    return $code;
  }
}
