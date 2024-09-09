<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use function Laravel\Folio\{middleware, name};
middleware(['guest']);
name('register');

new class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<x-guest-layout>
    @volt
        <div>
            <form wire:submit="register">
                <!-- Name -->
                <div>
                    <x-breeze.input-label for="name" :value="__('Name')" />
                    <x-breeze.text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name"
                        required autofocus autocomplete="name" />
                    <x-breeze.input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-breeze.input-label for="email" :value="__('Email')" />
                    <x-breeze.text-input wire:model="email" id="email" class="block mt-1 w-full" type="email"
                        name="email" required autocomplete="username" />
                    <x-breeze.input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-breeze.input-label for="password" :value="__('Password')" />

                    <x-breeze.text-input wire:model="password" id="password" class="block mt-1 w-full" type="password"
                        name="password" required autocomplete="new-password" />

                    <x-breeze.input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-breeze.input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-breeze.text-input wire:model="password_confirmation" id="password_confirmation"
                        class="block mt-1 w-full" type="password" name="password_confirmation" required
                        autocomplete="new-password" />

                    <x-breeze.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('login') }}" wire:navigate>
                        {{ __('Already registered?') }}
                    </a>

                    <x-breeze.primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-breeze.primary-button>
                </div>
            </form>
        </div>
    @endvolt
</x-guest-layout>
