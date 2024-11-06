<?php

namespace App\Livewire;

use Livewire\Component;

class SettingsMenu extends Component
{
    public function render()
    {
        return view('livewire.settings-menu');
    }

    public function goToUserManagement()
    {
        return redirect('/usermanagement');
    }
}
