<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    protected $fillable = [
        'title',
        'file_path',
        'thumbnail_path',
        'user_id',
        'visibility',
        'views',
        'likes'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
