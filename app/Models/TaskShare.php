<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class TaskShare extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'hash', 'tasks', 'show_all', 'expires_at'
    ];

    protected $casts = [
        'tasks' => 'array',
        'show_all' => 'boolean',
        'expires_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($share) {
            if (!$share->hash) {
                $share->hash = Str::random(32);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
