<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre_id',
        'title',
        'artist',
        'album',
        'duration',
        'cover_image',
        'audio_url',
        'is_explicit',
        'popularity_score',
    ];

    protected $casts = [
        'is_explicit' => 'boolean',
        'popularity_score' => 'integer',
    ];

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }
}