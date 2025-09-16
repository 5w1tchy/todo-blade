<?php

use App\Models\User;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

// 1) Guests are redirected to login
it('redirects guests from /todos to /login', function () {
    $this->get('/todos')->assertRedirect('/login');
});

// 2) Authenticated users see ONLY their own todos
it('shows only my todos on the list', function () {
    $me = User::factory()->create();
    $other = User::factory()->create();

    Todo::factory()->for($me, 'user')->create(['title' => 'Mine']);
    Todo::factory()->for($other, 'user')->create(['title' => 'Not mine']);

    $this->actingAs($me)
        ->get('/todos')
        ->assertOk()
        ->assertSee('Mine')
        ->assertDontSee('Not mine');
});
