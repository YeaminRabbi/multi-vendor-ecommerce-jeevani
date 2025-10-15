<?php

namespace App\Providers\Filament;

use App\Http\Middleware\CheckRole;
use App\Pages\SellerDashboard;
use App\Pages\SellerLogin;
use App\Pages\SellerRegistration;
use App\Policies\AdminPolicy;
use App\Traits\SellerPanel;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Notifications\Notification;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
class SellerPanelProvider extends PanelProvider
{

    public function panel(Panel $panel): Panel
    {
        return $panel
        ->id('seller')
        ->path('seller')
        ->login(SellerLogin::class)
        ->registration(SellerRegistration::class)
        ->colors([
            'primary' => Color::Amber,
        ])
        ->discoverResources(in: app_path('Filament/Seller/Resources'), for: 'App\\Filament\\Seller\\Resources')
        ->discoverPages(in: app_path('Filament/Seller/Pages'), for: 'App\\Filament\\Seller\\Pages')
        ->pages([
            SellerDashboard::class
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
        ->authGuard('web')
        ->authMiddleware([
            Authenticate::class,
        ])
        ->plugin(
            \TomatoPHP\FilamentEcommerce\FilamentEcommercePlugin::make()
                ->useCoupon(false)
                ->useGiftCard(false)
                ->useReferralCode(false)
                ->allowOrderExport(false)
                ->allowOrderImport(false)
                ->useWidgets()
                //->useAccounts(false)
                ->useOrderSettings(false)
                ->useSettings(false)
//                ->showOrderAccount(false)
//                ->allowOrderCreate(false)
                ->useCompany(false)
        )
        ->plugin(
            SpatieLaravelTranslatablePlugin::make()
                ->defaultLocales(['en', 'ar']),
        );
        ;
    }

    public function boot(): void
    {

        Panel::make('seller') // Create the panel instance
        ->id('seller')
        ->pages([ // Register pages to the seller panel
            SellerLogin::class,
            SellerDashboard::class,
        ]);


    }


}
