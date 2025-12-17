<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Brief extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'attachment_path',
        'ai_summary',
        'ai_tags',
        'ai_rewrite',
    ];

    protected $casts = [
        'ai_tags' => 'array',
        'ai_rewrite' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
