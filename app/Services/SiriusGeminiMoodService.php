<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SiriusGeminiMoodService
{
    public function analyze(string $note): array
    {
        if (!config('services.gemini.key')) {
            return [
                'success' => false,
                'message' => 'Gemini API key is missing.',
            ];
        }

        try {
            $model = config(
                'services.gemini.model',
                'gemini-2.5-flash'
            );

            $response = Http::timeout(25)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'x-goog-api-key' => config('services.gemini.key'),
                ])
                ->post(
                    "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent",
                    [
                        'contents' => [
                            [
                                'parts' => [
                                    [
                                        'text' => $this->buildPrompt($note),
                                    ],
                                ],
                            ],
                        ],

                        'generationConfig' => [
                            'temperature' => 0.2,
                            'maxOutputTokens' => 450,
                            'responseMimeType' => 'application/json',

                            'responseSchema' => [
                                'type' => 'OBJECT',

                                'properties' => [

                                    'mood' => [
                                        'type' => 'STRING',
                                        'enum' => [
                                            'Happy',
                                            'Calm',
                                            'Neutral',
                                            'Stressed',
                                            'Sad',
                                        ],
                                    ],

                                    'stress' => [
                                        'type' => 'INTEGER',
                                        'minimum' => 0,
                                        'maximum' => 100,
                                    ],

                                    'energy' => [
                                        'type' => 'INTEGER',
                                        'minimum' => 0,
                                        'maximum' => 100,
                                    ],

                                    'trigger' => [
                                        'type' => 'STRING',
                                        'enum' => [
                                            'Exam',
                                            'Assignment',
                                            'Part-time Job',
                                            'Sleep Problem',
                                            'Social Pressure',
                                            'Family',
                                            'Other',
                                        ],
                                    ],

                                    'confidence' => [
                                        'type' => 'STRING',
                                        'enum' => [
                                            'Low',
                                            'Medium',
                                            'High',
                                        ],
                                    ],

                                    'insight' => [
                                        'type' => 'STRING',
                                    ],

                                    'advice' => [
                                        'type' => 'ARRAY',

                                        'items' => [
                                            'type' => 'STRING',
                                        ],
                                    ],

                                    'support_needed' => [
                                        'type' => 'BOOLEAN',
                                    ],
                                ],

                                'required' => [
                                    'mood',
                                    'stress',
                                    'energy',
                                    'trigger',
                                    'confidence',
                                    'insight',
                                    'advice',
                                    'support_needed',
                                ],
                            ],
                        ],
                    ]
                );

            if (!$response->successful()) {

                Log::error(
                    'Gemini mood analysis failed',
                    [
                        'status' => $response->status(),
                        'body' => $response->body(),
                    ]
                );

                return [
                    'success' => false,
                    'message' =>
                        'Gemini request failed with status '
                        . $response->status(),
                ];
            }

            $text = data_get(
                $response->json(),
                'candidates.0.content.parts.0.text'
            );

            if (!$text) {
                return [
                    'success' => false,
                    'message' =>
                        'Gemini returned no readable response.',
                ];
            }

            $result = json_decode(
                trim($text),
                true
            );

            if (!is_array($result)) {
                return [
                    'success' => false,
                    'message' =>
                        'Gemini response could not be read.',
                ];
            }

            $allowedMoods = [
                'Happy',
                'Calm',
                'Neutral',
                'Stressed',
                'Sad',
            ];

            $allowedTriggers = [
                'Exam',
                'Assignment',
                'Part-time Job',
                'Sleep Problem',
                'Social Pressure',
                'Family',
                'Other',
            ];

            $mood = in_array(
                $result['mood'] ?? '',
                $allowedMoods,
                true
            )
                ? $result['mood']
                : 'Neutral';

            $trigger = in_array(
                $result['trigger'] ?? '',
                $allowedTriggers,
                true
            )
                ? $result['trigger']
                : 'Other';

            $stress = max(
                0,
                min(
                    100,
                    (int) ($result['stress'] ?? 50)
                )
            );

            $energy = max(
                0,
                min(
                    100,
                    (int) ($result['energy'] ?? 50)
                )
            );

            $advice = array_slice(
                array_values(
                    array_filter(
                        $result['advice'] ?? []
                    )
                ),
                0,
                3
            );

            /*
            |--------------------------------------------------------------------------
            | Sirius Safety Rule
            |--------------------------------------------------------------------------
            |
            | High stress always shows the support section,
            | even if the AI forgets to request it.
            |
            */

            $supportNeeded =
                $stress >= 75
                || (bool) (
                    $result['support_needed']
                    ?? false
                );

            return [
                'success' => true,

                'mood' => $mood,

                'stress' => $stress,

                'energy' => $energy,

                'trigger' => $trigger,

                'confidence' =>
                    $result['confidence']
                    ?? 'Medium',

                'insight' =>
                    $result['insight']
                    ?? 'This is a gentle AI estimate based on your reflection.',

                'advice' => $advice,

                'support_needed' =>
                    $supportNeeded,
            ];

        } catch (\Throwable $e) {

            Log::error(
                'Gemini mood analysis error',
                [
                    'error' => $e->getMessage(),
                ]
            );

            return [
                'success' => false,

                'message' =>
                    'Gemini error: '
                    . $e->getMessage(),
            ];
        }
    }


    private function buildPrompt(
        string $note
    ): string {

        return <<<PROMPT

You are Sirius, a friendly student wellness reflection assistant.

Analyze the student's short reflection and provide a gentle estimate.

Important rules:

- This is a wellness estimate, not a diagnosis.
- Never claim that the student has a medical or mental health condition.
- Use supportive and calm language.
- Do not make absolute conclusions.
- Estimate stress and energy from 0 to 100.
- Give exactly 3 short, practical, low-risk suggestions.
- Suggestions can include taking a short break, organizing one small task, resting, talking with someone trusted, or using student support resources.
- If estimated stress is 75 or above, set support_needed to true.
- When support_needed is true, gently encourage speaking with a trusted person, school counselor, or student support resource.
- Keep the insight under 35 words.
- Return only the requested JSON structure.

Student reflection:

{$note}

PROMPT;
    }
}