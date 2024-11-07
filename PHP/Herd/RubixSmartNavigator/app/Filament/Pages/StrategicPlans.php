<?php

namespace App\Filament\Pages;

use App\Filament\Resources\UserResource;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Tables\Actions\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class StrategicPlans extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Strategic Plans';
    //protected static ?string $slug = 'strategicplans'; // Custom URL slug
    protected static string $view = 'filament.pages.strategic-plans'; // Blade view fil 

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
        $navigationLabel = __('Strategic Plans');
    }
}
