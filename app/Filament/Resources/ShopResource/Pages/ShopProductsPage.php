<?php

namespace App\Filament\Resources\ShopResource\Pages;

use App\Filament\Resources\ShopResource;
use App\Models\Product;
use App\Models\Shop;
use Filament\Resources\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;

class ShopProductsPage extends Page implements HasTable
{
    use HasPageSidebar;
    use InteractsWithTable;

    public $record;

    protected static string $resource = ShopResource::class;

    protected static string $view = 'filament.resources.shop-resource.pages.shop-products-page';
    
    public $shop;

    public function mount($record)
    {
        $this->record = \App\Models\Shop::find($record);
    }

    protected function getTableQuery()
    {
        return Product::query()->where('shop_id', $this->record->id); // Query for products under the current shop
    }

    public function getTitle(): string
    {
        return 'All Products';
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
                ->label('Product Name')
                ->sortable()
                ->searchable(),
            TextColumn::make('price')
                ->label('Price')
                ->sortable(),
            TextColumn::make('created_at')
                ->label('Created At')
                ->dateTime()
                ->sortable(),
        ];
    }
}
