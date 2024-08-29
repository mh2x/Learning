<?php

use Livewire\Volt\Component;
use App\Models\User;
use Mary\Traits\Toast;
use Livewire\Attributes\Rule;
use App\Models\Country;
use Livewire\WithFileUploads;

new class extends Component {
    // We will use it later
    use Toast, WithFileUploads;

    // Component parameter
    public User $user;

    // You could use Livewire "form object" instead.
    #[Rule('required')]
    public string $name = '';

    #[Rule('required|email')]
    public string $email = '';

    // Optional
    #[Rule('sometimes')]
    public ?int $country_id = null;

    #[Rule('nullable|image|max:1024')]
    public $photo;

    // We also need this to fill Countries combobox on upcoming form
    public function with(): array
    {
        return [
            'countries' => Country::all(),
        ];
    }

    public function mount(): void
    {
        $this->fill($this->user);
    }

    public function save(): void
    {
        // Validate
        $data = $this->validate();

        // Update
        $this->user->update($data);

        // Upload file and save the avatar `url` on User model
        if ($this->photo) {
            $url = $this->photo->store('users', 'public');
            $this->user->update(['avatar' => "/storage/$url"]);
            //$this->Info("User has new avatar at {{$url}}");
        }

        // You can toast and redirect to any route
        $this->success('User updated with success.', redirectTo: '/users');
    }
}; ?>

<div>
    <x-header title="Edit User '{{ $user->name }}'" separator progress-indicator />
    <x-form wire:submit="save">
        <x-file label="Avatar" wire:model="photo" accept="image/png, image/jpeg">
            <img src="{{ $user->avatar ?? '/empty-user.jpg' }}" class="h-32 rounded-lg" />
        </x-file>

        <x-input label="Name" wire:model="name" />
        <x-input label="Email" wire:model="email" />
        <x-select label="Country" wire:model="country_id" :options="$countries" placeholder="---" />
        <x-slot:actions>
            <x-button label="Cancel" link="/users" />
            {{-- The important thing here is `type="submit"` --}}
            {{-- The spinner property is nice! --}}
            <x-button label="Save" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
        </x-slot:actions>
    </x-form>
</div>
