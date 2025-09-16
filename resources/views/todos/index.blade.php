<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Your Todos ({{ $todos->count() }})</h2>
</x-slot>

<div class="p-6">
    @if (session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif
        <a href="{{ route('todos.create') }}"
           class="inline-block mb-4 px-3 py-2 bg-gray-900 hover:bg-gray-800 text-white rounded">
            + New
        </a>
        @forelse ($todos as $t)
            <div class="py-2 flex items-center gap-3">
                <div class="min-w-0">
                    {{ $t->title }} @if($t->is_done) ✅ @endif
                </div>

                <form method="POST" action="{{ route('todos.toggle', $t) }}" class="inline">
                    @csrf
                    <button class="text-sm underline">
                        {{ $t->is_done ? 'Undo' : 'Mark done' }}
                    </button>
                </form>

                <a href="{{ route('todos.show', $t) }}" class="text-sm underline">View</a>
                <a href="{{ route('todos.edit', $t) }}" class="text-sm underline">Edit</a>

                <form method="POST" action="{{ route('todos.destroy', $t) }}" class="inline"
                      onsubmit="return confirm('Delete this todo?')">
                    @csrf
                    @method('DELETE')
                    <button class="text-sm underline text-red-600">Delete</button>
                </form>
            </div>
        @empty
            <p>No todos yet.</p>
        @endforelse
        <div class="mt-6">
            {{ $todos->links() }}
        </div>
</div>
</x-app-layout>
