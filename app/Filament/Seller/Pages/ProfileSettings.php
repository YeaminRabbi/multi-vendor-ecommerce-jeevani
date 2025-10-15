<?php

namespace App\Filament\Seller\Pages;

use App\Filament\Clusters\Settings;
use App\Models\Shop;
use App\Models\User;
use App\Traits\SellerPanel;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;
use Filament\Forms;

class ProfileSettings extends Page
{
    use SellerPanel;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Settings';

    protected static string $view = 'filament.seller.pages.settings';

    public $user;

    public function mount(): void
    {
        $this->user = auth()->user();
        $this->form->fill([
            'name' =>   $this->user->name,
            'email' =>   $this->user->email,
            'phone' =>   $this->user->phone,
            'profile_photo_path' =>   $this->user->profile_photo_path,
        ]);
    }

    public static function getNavigationLabel(): string
    {
        return 'Profile Settings';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->required(),
                TextInput::make('phone')
                    ->label('Phone')
                    ->required(),
                FileUpload::make('profile_photo_path')
                    ->label('Profile Photo')
                    ->directory('images/seller')
                    ->image(),
            ])
            ->statePath('user');
    }
    public function save()
    {
        $data = $this->form->getState();
        $user = User::find(auth()->user()->id);
        $user->update($data);
        Notification::make()
            ->title('Updated successfully')
            ->success()
            ->send();
    }

    protected function getActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')
                ->label('Save Changes')
                ->action(fn () => $this->save())
                ->icon('heroicon-o-check')
                ->color('primary'),
        ];
    }

}
