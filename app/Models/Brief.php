<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brief extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'attachment_path',
        'ai_responses',
    ];

    protected $casts = [
        'ai_responses' => 'array',
    ];
}
