<?php

use App\Models\User;

test('footer policy pages are accessible', function () {
    $this->get('/about-us')->assertOk()->assertSee('About Us');
    $this->get('/terms-and-conditions')->assertOk()->assertSee('Terms')->assertSee('Conditions');
    $this->get('/privacy-policy')->assertOk()->assertSee('Privacy Policy');
});

test('authenticated users can create and view journal entries', function () {
    $user = User::factory()->create();

    $createResponse = $this
        ->actingAs($user)
        ->post('/journal', [
            'title' => 'A calm evening',
            'content' => 'I took a slow walk and felt grounded.',
            'is_public' => false,
        ]);

    $createResponse
        ->assertRedirect('/journal')
        ->assertSessionHas('success', 'Journal entry saved!');

    $this->assertDatabaseHas('journals', [
        'user_id' => $user->id,
        'title' => 'A calm evening',
        'is_public' => false,
    ]);

    $viewResponse = $this
        ->actingAs($user)
        ->get('/journal');

    $viewResponse
        ->assertOk()
        ->assertSee('Private')
        ->assertSee('A calm evening');
});
