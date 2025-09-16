<?php

use App\Models\User;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('forbids deleting someone else’s todo', function () {
    $alice = User::factory()->create();
    $bob = User::factory()->create();
    $todo = Todo::factory()->for($alice, 'user')->create(['title' => 'Alice todo']);

    $this->actingAs($bob)
        ->delete(route('todos.destroy', $todo))
        ->assertForbidden();

    expect($todo->fresh())->not->toBeNull();
});

it('forbids toggling someone else’s todo', function () {
    $alice = User::factory()->create();
    $bob = User::factory()->create();
    $todo = Todo::factory()->for($alice, 'user')->create();

    $this->actingAs($bob)
        ->post(route('todos.toggle', $todo))
        ->assertForbidden();
});
