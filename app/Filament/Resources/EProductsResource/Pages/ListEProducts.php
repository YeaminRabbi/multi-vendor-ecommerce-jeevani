<?php

namespace App\Filament\Resources\EProductsResource\Pages;

use App\Filament\Resources\EProductsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEProducts extends ListRecords
{
    protected static string $resource = EProductsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
