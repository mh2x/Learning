<x-layout>
    <x-slot:heading>
        Create Job
    </x-slot:heading>
    <h2 class="font-bold text-lg">Create a new Job</h2>
    <!--
  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
    <form method="POST" action="/jobs">
        @csrf
        <div class="space-y-12">
            <p class="mt-1 text-sm leading-6 text-gray-600">We need a handful of details from you.</p>
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="title">Title</x-form-label>
                        <div class="mt-2">
                            <x-form-input type="text" name="title" id="title" placeholder="Manager" required />
                            <x-form-error name="title" />
                            <!-- <x-error for="title" /> -->
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="salary">Salary</x-form-label>
                        <div class="mt-2">
                            <x-form-input type="text" name="salary" id="salary" placeholder="$10000" required />
                            <x-form-error name="salary" />
                            <!-- <x-error for="title" /> -->
                        </div>
                    </x-form-field>
                </div>
            </div>
        </div>

        <div class="m-6 flex items-center justify-end gap-x-6">
            <a href="/jobs" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <div>
                <x-form-button>Save</x-form-button>
            </div>
        </div>
    </form>
</x-layout>
