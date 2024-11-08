<?php

namespace App\Providers\Filament;

use App\Filament\Pages\ApiTokens;
use App\Filament\Pages\CreateTeam;
use App\Filament\Pages\EditProfile;
use App\Filament\Pages\EditTeam;
use App\Listeners\SwitchTeam;
use App\Models\Team;
use Filament\Events\TenantSet;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Event;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\Jetstream;
use Filament\Navigation\Navigation;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\NavigationManager;
use Laravel\Jetstream\Http\Livewire\NavigationMenu;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $panel
            ->default()
            ->id('app')
            ->path('app')
            ->login()
            ->registration()
            ->profile()
            ->passwordReset()
            ->emailVerification()
            ->viteTheme('resources/css/app.css')
            ->colors([
                'primary' => Color::Fuchsia,
                'gray' => Color::Slate
            ])
            ->font('Poppins')
            ->favicon('/images/favicon-32x32.png')
            ->darkMode(true) //you can disable it completely
            // ->userMenuItems([
            //     MenuItem::make()
            //         ->label('Profile')
            //         ->icon('heroicon-o-user-circle')
            //         ->url(fn() => $this->shouldRegisterMenuItem()
            //             ? url(EditProfile::getUrl())
            //             : url($panel->getPath())),
            // ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
                EditProfile::class,
                ApiTokens::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,

            ])
            /*->sidebarCollapsibleOnDesktop()*/
            ->sidebarFullyCollapsibleOnDesktop()
            ->plugins([
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make()
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);

        if (Features::hasApiFeatures()) {
            $panel->userMenuItems([
                MenuItem::make()
                    ->label('API Tokens')
                    ->icon('heroicon-o-key')
                    ->url(fn() => $this->shouldRegisterMenuItem()
                        ? url(ApiTokens::getUrl())
                        : url($panel->getPath())),
            ]);
        }

        if (Features::hasTeamFeatures()) {
            $panel
                ->tenant(Team::class)
                ->tenantRegistration(CreateTeam::class)
                ->tenantProfile(EditTeam::class)
                ->userMenuItems([
                    MenuItem::make()
                        ->label('Team Settings')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->url(fn() => $this->shouldRegisterMenuItem()
                            ? url(EditTeam::getUrl())
                            : url($panel->getPath())),
                ]);
        }

        return $panel;
    }

    public function boot()
    {
        /**
         * Disable Fortify routes
         */
        Fortify::$registersRoutes = false;

        /**
         * Disable Jetstream routes
         */
        Jetstream::$registersRoutes = false;

        /**
         * Listen and switch team if tenant was changed
         */
        Event::listen(
            TenantSet::class,
            SwitchTeam::class,
        );

        /**
         * Adding additional and custom menu items if needed
         */
        Filament::serving(function () {

            Filament::registerUserMenuItems([
                //     MenuItem::make()
                //         ->label('Profile')
                //         ->url(EditProfile::getUrl())
                //         ->icon('heroicon-s-cog'),
                // ...
                'account' => MenuItem::make()->url(EditProfile::getUrl()),
            ]);

            //Add more user menu items
            // Add custom top bar menu item (e.g., Documentation link)
            if (auth()->user()?->can('viewDocumentation')) {
                Filament::registerUserMenuItems([
                    'documentation' => MenuItem::make()
                        ->label('Documentation')
                        ->url('https://example.com/docs')  // Link to external or internal docs
                        ->icon('heroicon-o-document-text'),
                ]);
            }

            // Example of adding another link (e.g., Settings)
            Filament::registerUserMenuItems([
                'settings' => MenuItem::make()
                    ->label('Settings')
                    //->url(route('filament.resources.settings')) // Link to a route in Filament
                    ->url('https://google.com')  // Link to external or internal docs
                    ->icon('heroicon-o-cog'),
            ]);


            Filament::registerNavigationItems([
                NavigationItem::make('Analytics')
                    ->url('https://filament.pirsch.io', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-presentation-chart-line')
                    ->activeIcon('heroicon-s-presentation-chart-line')
                    ->group('Reports')
                    ->sort(3),
            ]);
        });

        $this->registerRenderHooks();
    }

    public function shouldRegisterMenuItem(): bool
    {
        $hasVerifiedEmail = auth()->user()?->hasVerifiedEmail();

        return Filament::hasTenancy()
            ? $hasVerifiedEmail && Filament::getTenant()
            : $hasVerifiedEmail;
    }
    private function registerRenderHooks()
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::USER_MENU_AFTER,
            fn(): string => Blade::render('@livewire(\'settings-menu\')'),
        );
    }
}
