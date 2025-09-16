<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('requires title when creating a todo', function () {
    $user = User::factory()->create();

    $res = $this->actingAs($user)
        ->from('/todos/create')
        ->post('/todos', [
            'title' => '',
            'notes' => 'some notes',
        ]);

    $res->assertRedirect('/todos/create');
    $res->assertSessionHasErrors(['title']);

    // ensure nothing was created
    $this->assertDatabaseCount('todos', 0);
});
