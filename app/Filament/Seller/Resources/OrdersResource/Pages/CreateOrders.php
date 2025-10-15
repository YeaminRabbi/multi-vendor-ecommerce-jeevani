<?php

namespace App\Filament\Seller\Resources\OrdersResource\Pages;

use App\Filament\Seller\Resources\OrdersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrders extends CreateRecord
{
    protected static string $resource = OrdersResource::class;
}
