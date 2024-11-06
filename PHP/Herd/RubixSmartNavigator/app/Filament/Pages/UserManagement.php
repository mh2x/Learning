<?php

namespace App\Filament\Pages;

use App\Filament\Resources\UserResource;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use BezhanSalleh\FilamentShield\Support\Utils;

class UserManagement extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'User Management';
    //protected static ?string $slug = 'usermanagement'; // Custom URL slug
    protected static string $view = 'filament.pages.user-management'; // Blade view fil 

    public static function shouldRegisterNavigation(): bool
    {
        return Utils::isResourceNavigationRegistered();
    }

    public $activeTab = 'users'; // Default tab

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }
    public function boot() {}

    public function mount()
    {
        // Any initial setup logic here
        $navigationLabel = __('User Management');
    }
}
