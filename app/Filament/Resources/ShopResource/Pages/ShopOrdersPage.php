<?php

namespace App\Filament\Resources\ShopResource\Pages;

use App\Filament\Resources\ShopResource;
use App\Models\Order;
use App\Models\Shop;
use Filament\Resources\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Tables\Columns\ActionsColumn;
use Filament\Tables\Actions\Action;
use Filament\Tables;
use Filament\Tables\Table;

class ShopOrdersPage extends Page implements HasTable
{
    use HasPageSidebar;
    use InteractsWithTable;

    public $record;

    protected static string $resource = ShopResource::class;

    protected static string $view = 'filament.resources.shop-resource.pages.shop-orders-page';

    public function mount($record)
    {
        $this->record = \App\Models\Shop::find($record);
    }

    protected function getTableQuery()
    {
        $shopId = $this->record->id;
        $query = Order::whereHas('items', function ($query) use ($shopId) {
            $query->where('shop_id', $shopId);
        });

        return $query;
    }

    public function getTitle(): string
    {
        return 'All Orders';
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('view')
                ->label('View')
                ->modalHeading('Order Details') // Set modal heading
                ->modalSubheading('View the details of this order.') // Optional subheading
                ->modalContent(fn (Order $order) => view('filament.resources.shop-resource.pages.order-details-modal', [
                    'orderItems' => $order->items->where('shop_id', $this->record->id),
                ]))
                ->modalSubmitAction(false)
                ->modalCancelAction(false),
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')
                ->label('Order ID')
                ->sortable()
                ->searchable(),
            TextColumn::make('user.name')
                ->label('Customer')
                ->sortable()
                ->searchable(),
            TextColumn::make('status')
                ->label('Status')
                ->sortable()
                ->searchable(),
            TextColumn::make('created_at')
                ->label('Created At')
                ->dateTime()
                ->sortable()
                ->searchable(),
        ];
    }
}
