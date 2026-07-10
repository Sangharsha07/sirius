<?php

namespace App\Http\Controllers;

use App\Models\MoodEntry;
use App\Models\Goal;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private function getMoodEmoji($mood)
    {
        $moodMap = [
            'happy' => '😊',
            'calm' => '😌',
            'sad' => '😢',
            'anxious' => '😰',
            'angry' => '😠',
            'neutral' => '😐',
            'excited' => '🤩',
        ];

        return $moodMap[$mood] ?? '😊';
    }

    public function index()
    {
        $user = Auth::user();

        // Calculate average stress level from recent mood entries (last 7 days)
        $recentMoodEntries = MoodEntry::where('user_id', $user->id)
            ->where('created_at', '>=', now()->subDays(7))
            ->get();

        $stressLevel = $recentMoodEntries->isNotEmpty()
            ? round($recentMoodEntries->avg('stress_level'))
            : 0;

        // Get count of active goals
        $activeGoals = Goal::where('user_id', $user->id)
            ->where('status', 'In Progress')
            ->count();

        // Get latest mood entry for current mood display
        $latestMood = MoodEntry::where('user_id', $user->id)
            ->latest()
            ->first();

        $currentMoodEmoji = $latestMood ? $this->getMoodEmoji($latestMood->mood) : '😊';

        return view('dashboard', [
            'stressLevel' => $stressLevel,
            'activeGoals' => $activeGoals,
            'latestMood' => $latestMood,
            'currentMoodEmoji' => $currentMoodEmoji,
        ]);
    }
}

