<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Brief extends Model
{
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brief extends Model
{
    use HasFactory;

>>>>>>> d6a9fd3dfce3c7e14c12febe8a5c360c6f8e7009
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'attachment_path',
<<<<<<< HEAD
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
=======
        'ai_responses',
    ];

    protected $casts = [
        'ai_responses' => 'array',
    ];
>>>>>>> d6a9fd3dfce3c7e14c12febe8a5c360c6f8e7009
}
