<?php

namespace App\Filament\Seller\Resources\OrdersResource\Pages;

use App\Filament\Seller\Resources\OrdersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrdersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
