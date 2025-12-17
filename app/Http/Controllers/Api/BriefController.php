<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brief;
use Illuminate\Http\Request;

class BriefController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $brief = Brief::with('user:id,name')->find($id);

        if (!$brief) {
            return response()->json(['message' => 'Brief not found'], 404);
        }

        return response()->json([
            'id' => $brief->id,
            'title' => $brief->title,
            'content' => $brief->content,
            'author' => $brief->user->name,
            'created_at' => $brief->created_at,
            'ai_data' => [
                'summary' => $brief->ai_summary,
                'tags' => $brief->ai_tags,
                'rewrite' => $brief->ai_rewrite,
            ]
        ]);
    }
}
