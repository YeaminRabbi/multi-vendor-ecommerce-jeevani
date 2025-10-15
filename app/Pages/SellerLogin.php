<?php
namespace App\Pages;

use App\Models\Shop;
use App\Models\User;
use App\Models\Vendor;
use App\Providers\Filament\SellerPanelProvider;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Pages\Dashboard;
use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
class SellerLogin extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'seller.pages.seller-login';

    protected static string $routePath = 'login';

    public ?array $data = [];

    public static function getPanel(): string
    {
        return \App\Providers\Filament\SellerPanelProvider::class;
    }

    public function mount(): void
    {
        if (auth()->check()) {
            redirect()->to(SellerDashboard::getUrl());
        }

        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->required(),
            ])
            ->statePath('data');
    }

    public function login()
    {
        $data = $this->form->getState();
        // Ensure all values are strings
        $data = array_map(function ($value) {
            return is_string($value) ? trim($value) : $value;
        }, $data);

        if (Auth::attempt($data)) {
            // Regenerate session to prevent fixation attacks
            session()->regenerate();

            if(!auth()->user()->hasRole('seller')) {
                Auth::logout();
                Notification::make()
                    ->title('Access Denied')
                    ->body('You are not seller.')
                    ->danger()
                    ->send();
                return redirect(to: 'seller/login');
            }

            // Display notification
            Notification::make()
                ->title('Login successful')
                ->success()
                ->send();
            // Redirect to the seller dashboard
            return redirect(SellerDashboard::getUrl());

        }

        // If login fails
        Notification::make()
            ->title('Login failed')
            ->danger()
            ->send();
    }
    public function hasLogo()
    {
        return true;
    }

    public function getLayout() : string
    {
        return 'seller.pages.layout';
    }
    protected function getLayoutData(): array
    {
        return [
            'isGuest' => true
        ];
    }
}
