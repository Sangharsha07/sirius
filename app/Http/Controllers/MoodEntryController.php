<?php

namespace App\Http\Controllers;

use App\Models\MoodEntry;
use App\Services\SiriusGeminiMoodService;
use Illuminate\Http\Request;

class MoodEntryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Show Mood Page
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $moodEntries = MoodEntry::where(
            'user_id',
            auth()->id()
        )
            ->latest('entry_date')
            ->latest()
            ->get();

        return view(
            'mood',
            compact('moodEntries')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Analyze Reflection with Gemini
    |--------------------------------------------------------------------------
    */

    public function analyze(
        Request $request,
        SiriusGeminiMoodService $moodService
    ) {
        $validated = $request->validate([
            'note' => 'required|string|min:5|max:2000',
        ]);

        $result = $moodService->analyze(
            $validated['note']
        );

        if (!$result['success']) {
            return response()->json(
                [
                    'success' => false,

                    'message' =>
                        $result['message']
                        ?? 'Sirius could not analyze the reflection.',
                ],
                500
            );
        }

        return response()->json(
            $result
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Save Mood Entry
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mood' =>
                'required|string|max:50',

            'stress_level' =>
                'required|integer|min:0|max:100',

            'energy_level' =>
                'required|integer|min:0|max:100',

            'trigger' =>
                'nullable|string|max:100',

            'entry_date' =>
                'required|date',

            'note' =>
                'nullable|string|max:2000',

            'used_ai_suggestion' =>
                'nullable|boolean',

            'ai_suggested_mood' =>
                'nullable|string|max:50',

            'ai_suggested_stress' =>
                'nullable|integer|min:0|max:100',

            'ai_suggested_energy' =>
                'nullable|integer|min:0|max:100',

            'ai_suggested_trigger' =>
                'nullable|string|max:100',
        ]);

        $validated['user_id'] =
            auth()->id();

        MoodEntry::create(
            $validated
        );

        return redirect()
            ->route('mood.index')
            ->with(
                'success',
                'Mood entry saved successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Mood Entry
    |--------------------------------------------------------------------------
    */

    public function destroy(
        MoodEntry $moodEntry
    ) {
        if (
            $moodEntry->user_id
            != auth()->id()
        ) {
            abort(
                403,
                'You can only delete your own mood entries.'
            );
        }

        $moodEntry->delete();

        return redirect()
            ->route('mood.index')
            ->with(
                'success',
                'Mood entry deleted.'
            );
    }
}