<?php


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can create a todo', function () {
    $user = User::factory()->create();

    $res = $this->actingAs($user)->post('/todos', [
        'title' => 'Buy milk',
        'notes' => '2 liters',
    ]);

    $res->assertRedirect('/todos');

    $this->assertDatabaseHas('todos', [
        'user_id' => $user->id,
        'title' => 'Buy milk',
        'notes' => '2 liters',
        'is_done' => 0,
    ]);
});
