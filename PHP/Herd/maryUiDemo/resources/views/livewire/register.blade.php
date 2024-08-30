<?php
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Hash;

new class extends Component {
    #[Layout('components.layouts.guest')]
    #[Rule('required')]
    public string $name = '';
    #[Rule('required|email|unique:users')]
    public string $email = '';
    #[Rule('required|confirmed')]
    public string $password = '';
    #[Rule('required')]
    public string $password_confirmation = '';
    public function mount()
    {
        // It is logged in
        if (auth()->user()) {
            return redirect('/');
        }
    }

    public function register()
    {
        $data = $this->validate();

        $data['avatar'] = '/empty-user.jpg';
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        auth()->login($user);

        request()->session()->regenerate();

        return redirect('/');
    }
};
?>

<div class="md:w-96 mx-auto mt-20">
    <div class="mb-10">Cool image here</div>

    <x-form wire:submit="register">
        <x-input label="Name" wire:model="name" icon="o-user" inline />
        <x-input label="E-mail" wire:model="email" icon="o-envelope" inline />
        <x-input label="Password" wire:model="password" type="password" icon="o-key" inline />
        <x-input label="Confirm Password" wire:model="password_confirmation" type="password" icon="o-key" inline />

        <x-slot:actions>
            <x-button label="Already registered?" class="btn-link" link="/login" />
            <x-button label="Register" type="submit" icon="m-user-plus" class="btn-primary" spinner="register" />
        </x-slot:actions>
    </x-form>
</div>