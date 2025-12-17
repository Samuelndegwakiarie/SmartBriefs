<?php

namespace App\Jobs;

use App\Models\Brief;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProcessBriefAi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $brief;

    /**
     * Create a new job instance.
     */
    public function __construct(Brief $brief)
    {
        $this->brief = $brief;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $apiKey = config('services.gemini.key');
        
        if (!$apiKey) {
            Log::error('Gemini API key is not configured.');
            return;
        }

        $prompt = "Analyze the following text and provide a response in JSON format with three keys: 'summary' (a concise summary), 'tags' (an array of 3-6 keywords), and 'rewrite' (an object with keys 'Formal', 'Friendly', 'Shorter' containing rewritten versions). Text: " . $this->brief->content;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ],
            'generationConfig' => [
                 'responseMimeType' => 'application/json',
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            
            try {
                $textResponse = $data['candidates'][0]['content']['parts'][0]['text'];
                
                // Clean markdown code blocks if present
                $textResponse = preg_replace('/^```json\s*|\s*```$/', '', $textResponse);
                $jsonResponse = json_decode($textResponse, true);

                $this->brief->update([
                    'ai_summary' => $jsonResponse['summary'] ?? null,
                    'ai_tags' => $jsonResponse['tags'] ?? [],
                    'ai_rewrite' => $jsonResponse['rewrite'] ?? [],
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to parse Gemini response: ' . $e->getMessage());
            }
        } else {
            Log::error('Gemini API request failed: ' . $response->body());
        }
    }
}
