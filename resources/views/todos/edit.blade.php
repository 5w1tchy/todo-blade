<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Todo</h2>
    </x-slot>

    <div class="p-6 max-w-xl">
        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('todos.update', $todo) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium">Title</label>
                <input name="title" value="{{ old('title', $todo->title) }}" class="mt-1 block w-full border rounded p-2" required />
            </div>

            <div>
                <label class="block text-sm font-medium">Notes (optional)</label>
                <textarea name="notes" rows="4" class="mt-1 block w-full border rounded p-2">{{ old('notes', $todo->notes) }}</textarea>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('todos.index') }}" class="underline">Cancel</a>
                <button class="px-4 py-2 bg-indigo-600 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</x-app-layout>

