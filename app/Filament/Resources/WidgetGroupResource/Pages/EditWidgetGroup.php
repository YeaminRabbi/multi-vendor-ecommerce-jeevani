<?php

namespace App\Filament\Resources\WidgetGroupResource\Pages;

use App\Filament\Resources\WidgetGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWidgetGroup extends EditRecord
{
    protected static string $resource = WidgetGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
