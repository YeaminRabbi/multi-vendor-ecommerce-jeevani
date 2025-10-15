<?php

namespace App\Filament\Resources\ShopResource\Pages;

use App\Filament\Resources\ShopResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
// use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
class ListShops extends ListRecords
{
    // use HasPageSidebar; // use this trait to activate the Sidebar

    protected static string $resource = ShopResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
