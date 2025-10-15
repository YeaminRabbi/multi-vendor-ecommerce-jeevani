<?php

namespace App\Filament\Resources\EProductsResource\Pages;

use App\Filament\Resources\EProductsResource;
use App\Filament\Seller\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEProducts extends EditRecord
{
    protected static string $resource = EProductsResource::class;

    use EditRecord\Concerns\Translatable;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
