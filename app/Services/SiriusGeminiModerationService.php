<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SiriusGeminiModerationService
{
    public function checkAdvice(string $reply): array
    {
        if (!config('services.gemini.key')) {
            return [
                'success' => false,
                'status' => 'review',
                'reason' => 'Gemini API key is missing.',
            ];
        }

        try {
            $model = config('services.gemini.model', 'gemini-2.5-flash');

            $response = Http::timeout(25)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'x-goog-api-key' => config('services.gemini.key'),
                ])
                ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent", [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'text' => "You are Sirius, a safety checker for a student wellness support board.

Classify the student's reply as exactly one of these:
approved, review, blocked.

approved = kind, safe, supportive advice.
review = sensitive medical, therapy, diagnosis, crisis, or unclear advice.
blocked = bullying, harassment, harmful encouragement, unsafe advice, or telling someone to avoid real help.

Return JSON only:
{
  \"status\": \"approved\",
  \"reason\": \"short reason\"
}

Student reply:
{$reply}"
                                ],
                            ],
                        ],
                    ],
                    'generationConfig' => [
                        'temperature' => 0,
                        'maxOutputTokens' => 120,
                        'responseMimeType' => 'application/json',
                    ],
                ]);

            if (!$response->successful()) {
                Log::error('Gemini moderation failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return [
                    'success' => false,
                    'status' => 'review',
                    'reason' => 'Gemini failed. Status: ' . $response->status() . ' Body: ' . $response->body(),
                ];
            }

            $data = $response->json();

            $blockReason = data_get($data, 'promptFeedback.blockReason');

            if ($blockReason) {
                return [
                    'success' => true,
                    'status' => 'blocked',
                    'reason' => 'Gemini safety filter blocked this reply.',
                ];
            }

            $text = data_get($data, 'candidates.0.content.parts.0.text');

            if (!$text) {
                return [
                    'success' => false,
                    'status' => 'review',
                    'reason' => 'Gemini returned no readable response.',
                ];
            }

            $result = json_decode(trim($text), true);

            if (!$result || !isset($result['status'])) {
                return [
                    'success' => false,
                    'status' => 'review',
                    'reason' => 'Gemini response could not be parsed. Raw: ' . $text,
                ];
            }

            $allowedStatuses = ['approved', 'review', 'blocked'];

            if (!in_array($result['status'], $allowedStatuses)) {
                return [
                    'success' => false,
                    'status' => 'review',
                    'reason' => 'Gemini returned an unknown status.',
                ];
            }

            return [
                'success' => true,
                'status' => $result['status'],
                'reason' => $result['reason'] ?? 'Gemini moderation completed.',
            ];

        } catch (\Throwable $e) {
            Log::error('Gemini moderation error', [
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'status' => 'review',
                'reason' => 'Gemini error: ' . $e->getMessage(),
            ];
        }
    }
}