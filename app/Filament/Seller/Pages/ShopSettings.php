<?php

namespace App\Filament\Seller\Pages;

use App\Filament\Clusters\Settings;
use App\Models\Shop;
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

class ShopSettings extends Page
{
    use SellerPanel;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Settings';

    protected static string $view = 'filament.seller.pages.settings';

    public $shop;

    public function mount(): void
    {
        $this->shop = static::currentShopDetails();
        $this->form->fill([
            'name' => $this->shop->name,
            'description' => $this->shop->description,
            'logo' => $this->shop->logo,
            'cover_image' => $this->shop->cover_image,
        ]);
    }

    public static function getNavigationLabel(): string
    {
        return 'Shop Settings';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Shop Name')
                    ->required(),
                TextInput::make('description')
                    ->label('Description')
                    ->required(),
                FileUpload::make('logo')
                    ->label('Logo')
                    ->directory('images/seller')
                    ->image(),
                FileUpload::make('cover_image')
                    ->label('Cover Image')
                    ->directory('images/seller')
                    ->image(),
            ])
            ->statePath('shop');
    }
    public function save()
    {
        $data = $this->form->getState();
        $shop = Shop::find(static::currentShopId());
        $shop->update($data);
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
