<?php

namespace App\Filament\Resources\UserManagementResource\Pages;

use App\Filament\Resources\UserManagementResource;
use App\Models\UserManagement;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUserManagement extends CreateRecord
{
    protected static string $resource = UserManagementResource::class;
}
