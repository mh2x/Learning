<div>
    @if (session('error'))
        <section class="flex flex-col flex-wrap pt-12">
            <div class="flex flex-row flex-wrap justify-center">
                <div class="flex justify-center text-center m-2 h-24 w-64">
                    <div class="flex-shrink-0 rounded-full bg-gray-100 w-24 h-24 border border-red-700 z-10">
                        <i class="fas fa-triangle-exclamation fa-4x p-2 w-24 h-24 text-red-700"></i>
                    </div>
                    <div
                        class="flex flex-col text-left bg-red-700 text-white text-xs self-center pl-16 pr-4 py-2 -ml-12">
                        <h3 class="text-lg">Oops! Something went wrong!</h3>
                        <p class="w-96 text-sm overflow-y-hidden overflow-x-auto">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <div class="flex items-center justify-between p-3 border-t hover:bg-white/10">
        <div class="flex items-center">
            <div class="flex flex-col ml-2 space-y-3">
                @if ($editMode)
                    <div class="flex flex-row items-center space-x-2">
                        <input type="text" wire:model="newTodo" class="text-xl font-bold leading-snug text-blue-600"
                            value="{{ $todo->name }}">
                    </div>
                    <x-error name="newTodo" />
                @else
                    <div class="flex flex-row items-center space-x-2">
                        <input wire:click='toggleStatus' type="checkbox"
                            class="bg-gray-600 rounded-md cursor-pointer checked:bg-green-700 hover:bg-green-400"
                            {{ $todo->completed ? 'checked' : '' }} />
                        <div class="text-xl font-bold leading-snug text-white">{{ $todo->name }}</div>
                    </div>
                @endif
                <div class="flex flex-col">
                    <div class="leading-snug text-gray-400 text-sm">{{ $todo->created_at }}</div>
                    @unless ($todo->created_at->eq($todo->updated_at))
                        <span class="text-xs text-gray-500 italic hover:text-blue-500"> {{ __('modified on') }}
                            {{ $todo->updated_at }}</span>
                    @endunless
                </div>

                <div class="leading-snug {{ $this->statusTextColor() }} text-md">{{ $this->status() }}</div>

            </div>
        </div>
        <div class="flex flex-row space-x-1">
            @if ($editMode)
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
</div>
