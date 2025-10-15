<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShopResource\Pages;
use App\Filament\Resources\ShopResource\RelationManagers;
use App\Models\Shop;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use AymanAlhattami\FilamentPageWithSidebar\FilamentPageSidebar;
use AymanAlhattami\FilamentPageWithSidebar\PageNavigationItem;

class ShopResource extends Resource
{
    protected static ?string $model = Shop::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('slug')->required(),
                Forms\Components\Textarea::make('description'),
                Forms\Components\FileUpload::make('logo')->label('Shop Logo'),
                Forms\Components\FileUpload::make('cover_image')->label('Cover Image'),
                Forms\Components\Select::make('user_id')
                    ->label('Seller')
                    ->relationship('user', 'name')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('user.name')->label('Seller'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()
                ->url(fn ($record) => static::getUrl('overview', ['record' => $record])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function sidebar(?Model $record = null): FilamentPageSidebar
    {
        return FilamentPageSidebar::make()
            ->setNavigationItems([
                PageNavigationItem::make('Overview')
                    ->url(function () use ($record) {
                        return static::getUrl('overview', ['record' => $record->id]);
                    })
                    ->visible(true)
                    ->group('Shop'),
                    
                PageNavigationItem::make('View')
                    ->url(function () use ($record) {
                        return static::getUrl('view', ['record' => $record->id]);
                    })
                    ->visible(true)
                    ->group('Shop'),
                    
                PageNavigationItem::make('Edit')
                    ->url(function () use ($record) {
                        return static::getUrl('edit', ['record' => $record->id]);
                    })
                    ->visible(true)
                    ->group('Shop'),
                
                PageNavigationItem::make('Products')
                    ->url(function () use ($record) {
                        return static::getUrl('products', ['record' => $record->id]);
                    })
                    ->visible(true)
                    ->group('Activities'),

                PageNavigationItem::make('Orders')
                    ->url(function () use ($record) {
                        return static::getUrl('orders', ['record' => $record->id]);
                    })
                    ->visible(true)
                    ->group('Activities'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShops::route('/'),
            'create' => Pages\CreateShop::route('/create'),
            'edit' => Pages\EditShop::route('/{record}/edit'),
            'view' => Pages\ViewShop::route('/{record}/view'),
            'orders' => Pages\ShopOrdersPage::route('/{record}/orders'),
            'products' => Pages\ShopProductsPage::route('/{record}/products'),
            'overview' => Pages\ShopOverview::route('/{record}/overview'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            ShopResource\Widgets\ShopWidget::class,
        ];
    }
}
