<?php

namespace App\Http\Controllers;

use App\Models\MoodEntry;
use Illuminate\Http\Request;

class MoodEntryController extends Controller
{
    public function index()
    {
        $moodEntries = MoodEntry::latest()->get();

        return view('mood', compact('moodEntries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mood' => 'required|string|max:50',
            'stress_level' => 'required|integer|min:0|max:100',
            'energy_level' => 'required|integer|min:0|max:100',
            'trigger' => 'nullable|string|max:100',
            'entry_date' => 'required|date',
            'note' => 'nullable|string|max:2000',
            'used_ai_suggestion' => 'nullable|boolean',
            'ai_suggested_mood' => 'nullable|string|max:50',
            'ai_suggested_stress' => 'nullable|integer|min:0|max:100',
            'ai_suggested_energy' => 'nullable|integer|min:0|max:100',
            'ai_suggested_trigger' => 'nullable|string|max:100',
        ]);

        MoodEntry::create($validated);

        return redirect('/mood')->with('success', 'Mood entry saved successfully.');
    }

    public function destroy(MoodEntry $moodEntry)
    {
        $moodEntry->delete();

        return redirect('/mood')->with('success', 'Mood entry deleted.');
    }
}