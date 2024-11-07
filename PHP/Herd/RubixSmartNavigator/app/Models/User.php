<?php

namespace App\Models;

//use BezhanSalleh\FilamentShield\Facades\FilamentShield;
use Filament\Panel;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Models\Contracts\HasName;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Filament\Forms\Components\TextInput;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Notifications\Notifiable;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\CheckboxList;
use Filament\Models\Contracts\FilamentUser;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use BezhanSalleh\FilamentShield\FilamentShield;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser, HasAvatar /*,MustVerifyEmail*/
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use HasPanelShield;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFilamentName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        //TODO: enable in production
        if ($panel->getId() === 'admin') {
            //return str_ends_with($this->email, '@yourdomain.com') && $this->hasVerifiedEmail();
        }
        //return str_ends_with($this->email, '@yourdomain.com') && $this->hasVerifiedEmail();
        return true;
    }

    public static function getForm(): array
    {
        return [
            // Section::make()
            // ->schema([

            TextInput::make('name')
                ->required()
                ->maxLength(100),
            TextInput::make('email')
                ->required()
                ->email()
                ->unique(User::class, 'email', ignoreRecord: true),
            TextInput::make('password')
                // ->same('passwordConfirmation')
                ->password()
                ->revealable()
                ->maxLength(255)
                ->required(fn($component, $get, $model, $record, $set, $state) => $record === null)
                ->dehydrateStateUsing(fn($state) => ! empty($state) ? Hash::make($state) : '')
                ->default(function($component, $operation, $get, $model, $record, $set, $state) {
                    if ($operation  === 'create') {
                        return Str::password(12);
                    }
                }),
            TextInput::make('passwordConfirmation')
                ->password()
                ->dehydrated(false)
                ->maxLength(255),
            Select::make('roles')
                ->relationship('roles', 'name')
                ->multiple()
                ->preload()
                ->searchable(),

            Toggle::make('state')
                ->default(true)
                ->label(__('Status'))
                ->onIcon('heroicon-m-check-circle')
                ->offIcon('heroicon-m-x-circle'),
            // CheckboxList::make('roles')
            //     ->relationship('roles', 'name')
            //     ->searchable()

            // ])->columns(2),
        ];
    }
}
