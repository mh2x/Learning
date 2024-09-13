<x-app-layout>
    <x-slot:title>
        {{ __('Dashboard') }}
    </x-slot:title>

    <div class="py">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    {{ __("You're logged in!") }}
                    <p>Theme:{{ session('user_theme') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
