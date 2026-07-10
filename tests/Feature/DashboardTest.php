<?php

use App\Models\User;
use App\Models\MoodEntry;
use App\Models\Goal;

test('dashboard shows stress level calculated from recent mood entries', function () {
    $user = User::factory()->create();

    // Create mood entries with different stress levels
    MoodEntry::create([
        'user_id' => $user->id,
        'mood' => 'happy',
        'energy_level' => 8,
        'stress_level' => 30,
        'trigger' => 'Good sleep',
        'entry_date' => now()->toDateString(),
    ]);

    MoodEntry::create([
        'user_id' => $user->id,
        'mood' => 'calm',
        'energy_level' => 7,
        'stress_level' => 40,
        'trigger' => 'Morning walk',
        'entry_date' => now()->toDateString(),
    ]);

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertOk();
    // Average stress level should be (30 + 40) / 2 = 35
    $response->assertSee('35%');
});

test('dashboard shows count of active goals', function () {
    $user = User::factory()->create();

    // Create some goals
    Goal::create([
        'user_id' => $user->id,
        'title' => 'Sleep before 12 AM',
        'category' => 'Sleep',
        'target_date' => '2026-07-20',
        'status' => 'In Progress',
    ]);

    Goal::create([
        'user_id' => $user->id,
        'title' => 'Study for 2 hours',
        'category' => 'Study Balance',
        'target_date' => '2026-07-21',
        'status' => 'In Progress',
    ]);

    Goal::create([
        'user_id' => $user->id,
        'title' => 'Exercise',
        'category' => 'Exercise',
        'target_date' => '2026-07-22',
        'status' => 'Completed',
    ]);

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertOk();
    // Should show 2 active goals (the ones with 'In Progress' status)
    $response->assertSee('2');
});

test('dashboard shows latest mood', function () {
    $user = User::factory()->create();

    MoodEntry::create([
        'user_id' => $user->id,
        'mood' => 'sad',
        'energy_level' => 3,
        'stress_level' => 80,
        'trigger' => 'Lots of work',
        'entry_date' => now()->toDateString(),
    ]);

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertOk();
    $response->assertSee('😢');
});

