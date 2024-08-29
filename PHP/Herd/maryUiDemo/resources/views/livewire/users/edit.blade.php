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

    #[Rule('required|email')]
    public string $email = '';

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
    public function mount(): void
    {
        $this->fill($this->user);

        // Fill the selected languages property
        $this->my_languages = $this->user->languages->pluck('id')->all();
    }

    public function save(): void
    {
        // Validate
        $data = $this->validate();

        // Update
        $this->user->update($data);

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
        $this->success('User updated with success.', redirectTo: '/users');
    }
}; ?>

<div>
    <x-header title="Edit User '{{ $user->name }}'" separator progress-indicator />
    <!-- Grid stuff from Tailwind -->
    <div class="grid gap-5 lg:grid-cols-2">
        <x-form wire:submit="save">
            <!--crop-after-change attribute on x-file is failing-->
            <x-file label="Avatar" wire:model="photo" accept="image/png, image/jpeg">
                <img src="{{ $user->avatar ?? '/empty-user.jpg' }}" class="h-32 rounded-lg" />
            </x-file>

            <x-input label="Name" wire:model="name" />
            <x-input label="Email" wire:model="email" />

            <x-select label="Country" wire:model="country_id" :options="$countries" placeholder="---" />
            {{-- Multi selection --}}
            {{-- Pro tip: for larger lists use the x-choices component variation. --}}
            <x-choices-offline label="My languages" wire:model="my_languages" :options="$languages" searchable />

            <x-input wire:model="bio" label="Bio" hint="The great bio" />

            <x-slot:actions>
                <x-button label="Cancel" link="/users" />
                {{-- The important thing here is `type="submit"` --}}
                {{-- The spinner property is nice! --}}
                <x-button label="Save" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
            </x-slot:actions>
        </x-form>
        <div>
            {{-- Get a nice picture from `StorySet` web site --}}
            <img src="/edit-form.png" width="480" class="mx-auto" />
        </div>
    </div>
</div>
