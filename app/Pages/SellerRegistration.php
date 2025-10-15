<?php
// In app/Filament/Pages/SellerRegistration.php
namespace App\Pages;

use App\Models\Shop;
use App\Models\User;
use App\Models\Vendor;
use App\Traits\SellerPanel;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Filament\Notifications\Notification;

class SellerRegistration extends Page
{

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'seller.pages.seller-registration';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public static function getPanel(): string
    {
        return SellerDashboard::class;
    }

    public function mount(): void
    {
        if (auth()->check()) {
            redirect()->to(static::getPanel()::getUrl());
        }

        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(User::class),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->minLength(8)
                    ->confirmed(),
                TextInput::make('password_confirmation')
                    ->password()
                    ->required(),
                TextInput::make('shop_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                Textarea::make('address')
                    ->required()
                    ->maxLength(1000),
            ])
            ->statePath('data');
    }

    public function register()
    {
        $data = $this->form->getState();
        // Ensure all values are strings
        $data = array_map(function ($value) {
            return is_string($value) ? trim($value) : $value;
        }, $data);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('seller');

        Shop::create([
            'user_id' => $user->id,
            'name' => $data['shop_name'],
            'slug' => str_replace(' ', '', $data['shop_name']).$user->id,
            'phone' => $data['phone'],
            'address' => $data['address'],
        ]);

        Notification::make()
            ->title('Registration successful')
            ->success()
            ->send();

        return redirect()->route('filament.seller.auth.login');
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
