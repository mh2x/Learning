<?php

use Livewire\Volt\Component;
use App\Models\User;
use App\Models\Language;
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

    #[Rule('required|email|unique:users')]
    public string $email = '';

    #[Rule('required|min:5')]
    public string $password = '';

    #[Rule('required|min:5|same:password')]
    public string $password_confirmation = '';

    // Optional
    #[Rule('sometimes')]
    public ?int $country_id = null;

    #[Rule('nullable|image|max:1024')]
    public $photo;

    // Selected languages
    #[Rule('required')]
    public array $my_languages = [];

    // Optional
    #[Rule('sometimes')]
    public ?string $bio = null;

    // We also need this to fill Countries combobox on upcoming form
    //with makes data available to the view of our components
    //so we can access them
    //The with method returns an associative array where the keys are variable names that
    //you can use in your view, and the values are the data you want to pass to the view.
    public function with(): array
    {
        return [
            'countries' => Country::all(),
            'languages' => Language::all(), // Available Languages
        ];
    }

    public function save(): void
    {
        // Validate
        $data = $this->validate();

        // Update
        $this->user = User::create($data);

        // Sync selection
        //This will update and fix the many-to-many table
        $this->user->languages()->sync($this->my_languages);

        // Upload file and save the avatar `url` on User model
        if ($this->photo) {
            //BUGBUG: temp images are not cleared from \maryUiDemo\storage\app\livewire-tmp
            //https://github.com/livewire/livewire/discussions/3470
            //// Clean the Livewire temp-upload folder
            //\Illuminate\Support\Facades\File::cleanDirectory(\storage_path('app/livewire-tmp'));

            $url = $this->photo->store('users', 'public');

            $this->user->update(['avatar' => "/storage/$url"]);
            //$this->Info("User has new avatar at {{$url}}");
        }

        // You can toast and redirect to any route
        $this->success('User created with success.', redirectTo: '/users');
    }
}; ?>

<div>
    <x-header title="Create New User" separator progress-indicator />

    <x-form wire:submit="save">
        {{--  Basic section  --}}
        <div class="lg:grid grid-cols-5">
            <div class="col-span-2">
                <x-header title="Basic" subtitle="Basic info from user" size="text-2xl" />
            </div>
            <div class="col-span-2 grid gap-3">
                <!--crop-after-change attribute on x-file is failing-->
                <x-file label="Avatar" wire:model="photo" accept="image/png, image/jpeg">
                    <img src="{{ $user->avatar ?? '/empty-user.jpg' }}" class="h-40 rounded-lg" />
                </x-file>

                <x-input label="Name" wire:model="name" />
                <x-input label="Email" wire:model="email" type="email" />
                <x-input label="Password" wire:model="password" type="password" />
                <x-input label="Confirm Password" wire:model="password_confirmation" type="password" />
                <x-select label="Country" wire:model="country_id" :options="$countries" placeholder="---" />
            </div>
        </div>

        {{--  Details section --}}
        <x-hr class="my-5" />
        <div class="lg:grid grid-cols-5">
            <div class="col-span-2">
                <x-header title="Details" subtitle="More about the user" size="text-2xl" />
            </div>
            <div class="col-span-2 grid gap-3">
                {{-- Multi selection --}}
                {{-- Pro tip: for larger lists use the x-choices component variation. --}}
                <x-choices-offline label="My languages" wire:model="my_languages" :options="$languages" searchable />

                <x-input wire:model="bio" label="Bio" hint="The great bio" />

            </div>
        </div>

        <x-slot:actions>
            <x-button label="Cancel" link="/users" />
            {{-- The important thing here is `type="submit"` --}}
            {{-- The spinner property is nice! --}}
            <x-button label="Create" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
        </x-slot:actions>
    </x-form>
</div>
