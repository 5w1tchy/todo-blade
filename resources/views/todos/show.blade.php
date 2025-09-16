<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">{{ $todo->title }}</h2>
</x-slot>

<div class="p-6 max-w-2xl space-y-4">
    <div>
        Status:
        @if ($todo->is_done)
            <span class="text-green-600">Done</span>
        @else
            <span class="text-gray-600">Pending</span>
        @endif
    </div>

    @if ($todo->notes)
        <div class="whitespace-pre-line">{{ $todo->notes }}</div>
    @else
        <div class="text-gray-500">No notes.</div>
    @endif

    <div class="flex gap-4">
        <a href="{{ route('todos.edit', $todo) }}" class="underline">Edit</a>
        <a href="{{ route('todos.index') }}" class="underline">Back</a>
    </div>
</div>
</x-app-layout>
