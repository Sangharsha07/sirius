<?php

use App\Models\User;

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
