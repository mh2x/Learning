<div class="flex items-center justify-between p-3 border-t hover:bg-white/10">
    <div class="flex items-center">
        <div class="flex flex-col ml-2 space-y-3">
            <div class="flex flex-row items-center space-x-2">
                <input wire:click='toggleStatus' type="checkbox"
                    class="bg-gray-600 rounded-md cursor-pointer checked:bg-green-700"
                    {{ $this->todo->completed ? 'checked' : '' }} />
                <div class="text-xl font-bold leading-snug text-white">{{ $todo->name }}</div>
            </div>
            <div class="leading-snug text-gray-400 text-md">{{ $todo->created_at }}</div>
            <div class="leading-snug {{ $this->statusTextColor() }} text-md">{{ $this->status() }}</div>
        </div>
    </div>
    <div class="flex flex-row space-x-1">
        <button
            class="h-8 px-3 font-bold text-blue-400 border border-blue-400 rounded-full cursor-pointer text-md hover:bg-blue-400/25">Edit</button>
        <button
            class="h-8 px-3 font-bold text-red-400 border border-red-400 rounded-full cursor-pointer text-md hover:bg-red-400/25"
            wire:click="delete" wire:confirm="Are you sure you want to delete this todo?">
            Delete
        </button>
    </div>
</div>
