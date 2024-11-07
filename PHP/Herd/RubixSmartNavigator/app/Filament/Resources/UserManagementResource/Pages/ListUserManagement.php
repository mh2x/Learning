<?php

namespace App\Filament\Resources\UserManagementResource\Pages;

use App\Filament\Resources\UserManagementResource;
use App\Filament\Resources\Shield\RoleResource as ShieldRoleResource;
use App\Filament\Resources\UserResource;
use App\Models\User;
use BezhanSalleh\FilamentShield\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Tables;
use Filament\Tables\Table;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Spatie\Permission\Models\Role;
use Filament\Tables\Actions\Action;
use App\Filament\Resources\UserResource\Pages;

class ListUserManagement extends ListRecords
{
    protected static string $resource = UserResource::class;
    protected static string $view = 'filament.resources.posts.pages.list-posts';

    public function getBreadcrumb(): ?string
    {
        return null;
    }

    public function getTitle(): string | Htmlable
    {
        return "";
    }

    protected function shouldShowBreadcrumbs(): bool
    {
        return false; // Hide breadcrumbs
    }

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
    public function boot()
    {
        $this->activeTab = 'users'; // Default tab    
    }

    public function switchTab($tab)
    {
        if ($tab === 'users') {
            static::$resource = UserResource::class;
        } else {
            //static::$resource = RoleResource::class;
            static::$resource = ShieldRoleResource::class;
        }
        $this->activeTab = $tab;
        $this->resetTable();
        //dd($action = $this->table->getActions());
        //$this->configureTableAction()
        //$this->reset('tableFilters', 'tableSortColumn', 'tableSortDirection');
        $this->updatedActiveTab();
    }
}
