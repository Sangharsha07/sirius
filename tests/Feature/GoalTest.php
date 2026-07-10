<?php

use App\Models\User;
use App\Models\Goal;

test('authenticated users can create and view goals', function () {
    $user = User::factory()->create();

    $createResponse = $this
        ->actingAs($user)
        ->post('/goals', [
            'title' => 'Sleep before 12 AM',
            'category' => 'Sleep',
            'target_date' => '2026-07-20',
        ]);

    $createResponse
        ->assertRedirect('/goals')
        ->assertSessionHas('success', 'Goal added successfully!');

    $this->assertDatabaseHas('goals', [
        'user_id' => $user->id,
        'title' => 'Sleep before 12 AM',
        'category' => 'Sleep',
    ]);

    $viewResponse = $this
        ->actingAs($user)
        ->get('/goals');

    $viewResponse
        ->assertOk()
        ->assertSee('Wellness Goals')
        ->assertSee('Sleep before 12 AM');
});

test('goals are isolated per user', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    // User 1 creates a goal
    Goal::create([
        'user_id' => $user1->id,
        'title' => 'User 1 Goal',
        'category' => 'Health',
        'target_date' => '2026-07-20',
        'status' => 'In Progress',
    ]);

    // User 2 creates a different goal
    Goal::create([
        'user_id' => $user2->id,
        'title' => 'User 2 Goal',
        'category' => 'Study',
        'target_date' => '2026-07-21',
        'status' => 'In Progress',
    ]);

    // User 1 should only see their own goal
    $user1Response = $this->actingAs($user1)->get('/goals');
    $user1Response->assertSee('User 1 Goal');
    $user1Response->assertDontSee('User 2 Goal');

    // User 2 should only see their own goal
    $user2Response = $this->actingAs($user2)->get('/goals');
    $user2Response->assertSee('User 2 Goal');
    $user2Response->assertDontSee('User 1 Goal');
});
