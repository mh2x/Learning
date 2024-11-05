<div>
    <x-filament::dropdown width="xs">
        <x-slot name="trigger">
            <button class="p-2 hover:text-gray-700 focus:outline-none">
                <x-filament::icon alias="filament-settings" icon="heroicon-o-cog-6-tooth" class="w-5 h-5" />
            </button>
        </x-slot>
        <div class="text-xs text-gray-500">Settings</div>
        <x-filament::dropdown.list>
            <x-filament::dropdown.list.item icon="heroicon-s-adjustments-horizontal" wire:click="openViewModal"
                class="text-xs" icon-size="sm">
                {{ 'System Customization' }}
            </x-filament::dropdown.list.item>

            <x-filament::dropdown.list.item icon="heroicon-o-users" wire:click="openEditModal" class="text-xs"
                icon-size="sm">
                {{ 'User Management' }}
            </x-filament::dropdown.list.item>

            <x-filament::dropdown.list.item icon="heroicon-c-arrows-right-left" wire:click="openDeleteModal"
                class="text-xs" icon-size="sm">
                {{ 'Workflow Management' }}
            </x-filament::dropdown.list.item>
        </x-filament::dropdown.list>
    </x-filament::dropdown>
</div>
