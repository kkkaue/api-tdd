<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ShortUrl extends Model
{
    use HasFactory;

    public function visits(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Visit::class);
    }

    public function getLastVisitAttribute(): Carbon
    {
        return $this->visits()->latest()->first()->created_at;
    }
}
