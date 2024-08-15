<x-layout>
    <x-slot:heading>
        Register User
    </x-slot:heading>
    <h2 class="font-bold text-lg">Register a new User</h2>
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
    <form method="POST" action="/register">
        @csrf
        <div class="space-y-12">
            <p class="mt-1 text-sm leading-6 text-gray-600">We need a handful of details from you.</p>
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="title">Name</x-form-label>
                        <div class="mt-2">
                            <x-form-input
                                type="text"
                                name="name"
                                id="name"
                                required />
                            <x-form-error name="name" />
                            <!-- <x-error for="title" /> -->
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="email">Email</x-form-label>
                        <div class="mt-2">
                            <x-form-input
                                type="email"
                                name="email"
                                id="email"
                                required />
                            <x-form-error name="email" />
                            <!-- <x-error for="title" /> -->
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="password">Password</x-form-label>
                        <div class="mt-2">
                            <x-form-input
                                type="password"
                                name="password"
                                id="password"
                                required />
                            <x-form-error name="password" />
                            <!-- <x-error for="title" /> -->
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="password_confirmation">Confirm Password</x-form-label>
                        <div class="mt-2">
                            <x-form-input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                required />
                            <x-form-error name="password_confirmation" />
                            <!-- <x-error for="title" /> -->
                        </div>
                    </x-form-field>
                </div>
            </div>
        </div>

        <div class="m-6 flex items-center justify-end gap-x-6">
            <a href="/" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <div>
                <x-form-button>Register</x-form-button>
            </div>
        </div>
    </form>
</x-layout>
