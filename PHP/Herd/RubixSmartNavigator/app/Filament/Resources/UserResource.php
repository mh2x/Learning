<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use function Pest\Laravel\options;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Toggle;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Filament\Resources\UserResource\RelationManagers;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use BezhanSalleh\FilamentShield\Support\Utils;

class UserResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    public static function shouldRegisterNavigation(): bool
    {
        return Utils::isResourceNavigationRegistered();
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            // 'view',
            'view_any',
            'create',
            'update',
            'delete',
            // 'delete_any',
        ];
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema(User::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('id')
                //     ->sortable(),
                ImageColumn::make('profile_photo_url')
                    ->label('Avatar')
                    ->circular(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->alignLeft(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->color('gray')
                    ->alignLeft(),
                TextColumn::make('roles.name')->badge(),
                ToggleColumn::make('status')
                    ->label(__('State'))
                    ->onIcon('heroicon-m-check-circle')
                    ->offIcon('heroicon-m-x-circle'),
                // IconColumn::make('email_verified_at')
                //     ->label(__('Verified'))
                //     ->default(false)
                //     ->boolean(),
                // Toggle::make('email_verified_at')
                //     ->onIcon('heroicon-m-bolt')
                //     ->offIcon('heroicon-m-user'),
                // TextColumn::make('created_at')
                //     ->label(__('Created'))
                //     ->dateTime('d-m-Y')
                //     ->sortable()
                //     ->visibleFrom('lg'),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_at')->label('Date added')
                            ->placeholder(fn($state): string => now()->format('M d, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query

                            ->when(
                                $data['created_at'] ?? null,
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['created_at'] ?? null) {
                            $indicators['created_at'] = 'Date added ' . Carbon::parse($data['created_at'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
                SelectFilter::make('roles')->label(__('Role'))
                    ->relationship('roles', 'name'),
                SelectFilter::make('Status')->label(__('Status'))
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive'
                    ])
            ])
            ->actions([
                //Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            // 'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
