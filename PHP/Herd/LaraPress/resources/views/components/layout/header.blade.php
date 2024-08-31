@props(['title' => 'NOTITLE'])

<div>
    <div class="w-full dark:bg-gray-800">
        {{-- NAVBAR mobile only --}}
        <x-nav sticky class="lg:hidden">
            <x-slot:brand>
                <x-app-brand />
            </x-slot:brand>
            <x-slot:actions>
                <label for="main-drawer" class="lg:hidden me-3">
                    <x-icon name="o-bars-3" class="cursor-pointer" />
                </label>
            </x-slot:actions>
        </x-nav>

        {{-- NAVBAR mobile only --}}
        <x-nav sticky full-width progress-indicator>
            <x-slot:brand>
                <div class="hidden lg:block mr-20">
                    <x-app-brand />
                </div>

                <h2 class="font-bold text-2xl dark:text-white leading-tight">
                    {{ $title }}
                </h2>

                <div class="w-full flex flex-row justify-end items-center">
                    <x-nav-menu />
                </div>
            </x-slot:brand>
            <div>
                <x-slot:middle class="!justify-center">
                    <x-slot:actions>
                        <livewire:user-dropdown />
                    </x-slot:actions>
                </x-slot:middle>
            </div>
        </x-nav>

    </div>
</div>