<div class="flex items-center justify-between p-3 border-t hover:bg-white/10">
    <div class="flex items-center">
        <div class="flex flex-col ml-2 space-y-3">
            @if ($this->editMode)
                <div class="flex flex-row items-center space-x-2">
                    <input type="text" wire:model="newName" class="text-xl font-bold leading-snug text-blue-600"
                        value="{{ $todo->name }}">
                </div>
            @else
                <div class="flex flex-row items-center space-x-2">
                    <input wire:click='toggleStatus' type="checkbox"
                        class="bg-gray-600 rounded-md cursor-pointer checked:bg-green-700 hover:bg-green-400"
                        {{ $this->todo->completed ? 'checked' : '' }} />
                    <div class="text-xl font-bold leading-snug text-white">{{ $todo->name }}</div>
                </div>
            @endif
            <div class="flex flex-col">
                <div class="leading-snug text-gray-400 text-sm">{{ $todo->created_at }}</div>
                @unless ($this->todo->created_at->eq($this->todo->updated_at))
                    <span class="text-xs text-gray-500 italic hover:text-blue-500"> {{ __('modified on') }}
                        {{ $this->todo->updated_at }}</span>
                @endunless
            </div>

            <div class="leading-snug {{ $this->statusTextColor() }} text-md">{{ $this->status() }}</div>

        </div>
    </div>
    <div class="flex flex-row space-x-1">
        @if ($this->editMode)
            <button wire:click='update' id="update" name="update"
                class="h-8 px-3 font-bold text-blue-400 border border-blue-400 rounded-full cursor-pointer text-md hover:bg-blue-400/25">Update</button>
            <button wire:click="cancelEdit"
                class="h-8 px-3 font-bold text-gray-400 border border-gray-500 rounded-full cursor-pointer text-md hover:bg-gray-400/25">
                Cancel </button>
        @else
            <button wire:click='edit' id="edit" name="edit"
                class="h-8 px-3 font-bold text-blue-400 border border-blue-400 rounded-full cursor-pointer text-md hover:bg-blue-400/25">Edit</button>
            <button wire:click="delete"
                class="h-8 px-3 font-bold text-red-400 border border-red-400 rounded-full cursor-pointer text-md hover:bg-red-400/25"
                id="delete" name="delete" wire:confirm="Are you sure you want to HAHAH delete this todo?">
                Delete
            </button>
        @endif
    </div>
</div>
