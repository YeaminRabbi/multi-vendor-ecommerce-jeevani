<?php

namespace Junk\WidgetResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Junk\WidgetResource;

class EditWidget extends EditRecord
{
    protected static string $resource = WidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
