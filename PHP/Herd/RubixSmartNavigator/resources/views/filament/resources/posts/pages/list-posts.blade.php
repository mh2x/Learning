<x-filament-panels::page>
    <h1 class="text-3xl font-bold">{{ __('User Management') }}</h1>
    <p class="text-xs text-gray-400">
        {{ __('Manage user accounts, roles, and permissions to control access and maintain security within your organization.') }}
    </p>
    <x-filament::card>
        <x-filament::tabs>
            <!-- Tab Title for Users -->
            <x-filament::tabs.item label="users" :active="$activeTab === 'users'" wire:click="switchTab('users')">
                <p class="text-lg font-bold">{{ __('Users') }}</p>
                @if ($activeTab === 'users')
                    <hr class="border-b-2 border-secondary-subtle" />
                @endif

            </x-filament::tabs.item>

            <!-- Tab Title for Roles -->
            <x-filament::tabs.item label="roles" :active="$activeTab === 'roles'" wire:click="switchTab('roles')">
                <p class="text-lg font-bold">{{ __('Roles') }}</p>
                @if ($activeTab === 'roles')
                    <hr class="border-b-2 border-secondary-subtle" />
                @endif
            </x-filament::tabs.item>
        </x-filament::tabs>

        <div class="mt-4">
            <!-- Tab Content for User List -->
            @if ($activeTab === 'users')
                <!-- Content for User List tab -->
                <div class="p-4">
                    <h2 class="text-lg font-bold">{{ __('Users') }}</h2>
                    <!-- User Resource Table -->
                    <div class="flex justify-between items-center w-full mb-4">
                        <p class="text-xs text-gray-400">
                            {{ __('Manage user accounts, roles, and activity status across your organization.') }}</p>
                        <x-filament::button wire:click="customAction" color="primary" icon="heroicon-o-plus"
                            class="right">
                            {{ __('Add User') }}
                        </x-filament::button>
                    </div>
                    {{ $this->table }}
                </div>
            @endif

            <!-- Tab Content for Roles -->
            @if ($activeTab === 'roles')
                <!-- Content for Roles & Permissions -->
                <div class="p-4">
                    <h2 class="text-lg font-bold">{{ __('Roles & Permissions') }}</h2>
                    <!-- User Resource Table -->
                    <div class="flex justify-between items-center w-full mb-4">
                        <p class="text-xs text-gray-400">
                            {{ __('Define and assign roles with specific access permissions to ensure secure, role-based access control.') }}
                        </p>

                        <x-filament::button wire:click="customAction" color="primary" icon="heroicon-o-plus"
                            class="right">
                            {{ __('Add Role') }}
                        </x-filament::button>
                    </div>
                    {{ $this->table }}
                </div>
            @endif
        </div>
    </x-filament::card>
</x-filament-panels::page>
