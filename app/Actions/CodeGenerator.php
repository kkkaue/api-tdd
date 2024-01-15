<?php

namespace App\Actions;

use Illuminate\Support\Str;

class CodeGenerator
{
  public static function run(): string
  {
    return Str::random(5);
  }
}
