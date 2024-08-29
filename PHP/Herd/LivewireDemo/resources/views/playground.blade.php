<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Playground') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-8 m-8 bg-white shadow-sm dark:bg-gray-800 dark:text-white sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Welcome to Livewire Demo Playground!') }}

                </div>
                <div>
                    <livewire:hello-world />
                </div>
                <div>
                    <livewire:counter />
                </div>
            </div>
        </div>
        <div>
            <script src="//unpkg.com/alpinejs"></script>
            <div x-data="{
                openTab: 1,
                activeClasses: 'border-l border-t border-r rounded-t text-blue-700',
                inactiveClasses: 'text-blue-500 hover:text-blue-700'
            }" class="p-6">
                <ul class="flex border-b">
                    <li @click="openTab = 1" :class="{ '-mb-px': openTab === 1 }" class="-mb-px mr-1">
                        <a href="#" :class="openTab === 1 ? activeClasses : inactiveClasses"
                            class="bg-white inline-block py-2 px-4 font-semibold">
                            Active
                        </a>
                    </li>
                    <li @click="openTab = 2" :class="{ '-mb-px': openTab === 2 }" class="mr-1">
                        <!-- Set active class by using :class provided by Alpine -->
                        <a href="#" :class="openTab === 2 ? activeClasses : inactiveClasses"
                            class="bg-white inline-block py-2 px-4 font-semibold">
                            Tab
                        </a>
                    </li>
                    <li @click="openTab = 3" :class="{ '-mb-px': openTab === 3 }" class="mr-1">
                        <a href="#" :class="openTab === 3 ? activeClasses : inactiveClasses"
                            class="bg-white inline-block py-2 px-4 font-semibold">
                            Tab
                        </a>
                    </li>
                </ul>
                <div class="w-full">
                    <div x-show="openTab === 1">Tab #1</div>
                    <div x-show="openTab === 2">Tab #2</div>
                    <div x-show="openTab === 3">Tab #3</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
