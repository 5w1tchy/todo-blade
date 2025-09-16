<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Apply policy to resource actions.
     */
    public function __construct()
    {
        $this->authorizeResource(Todo::class, 'todo');
    }

    /**
     * Display a paginated list of the user's todos.
     */
    public function index()
    {
        $todos = auth()->user()->todos()->latest()->paginate(8);

        return view('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new todo.
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created todo.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        auth()->user()->todos()->create($data);

        return redirect()->route('todos.index')->with('success', 'Todo created.');
    }

    /**
     * Toggle completion status for a todo.
     */
    public function toggle(Todo $todo)
    {
        // Policy check (explicit for clarity; resource policy also covers update)
        $this->authorize('update', $todo);

        $todo->is_done = ! $todo->is_done;
        $todo->save();

        return back()->with('success', 'Todo updated.');
    }

    /**
     * Display a single todo (details page).
     */
    public function show(Todo $todo)
    {
        return view('todos.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified todo.
     */
    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified todo.
     */
    public function update(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        $todo->update($data);

        return redirect()->route('todos.index')->with('success', 'Todo updated.');
    }

    /**
     * Remove the specified todo.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return back()->with('success', 'Todo deleted.');
    }
}
