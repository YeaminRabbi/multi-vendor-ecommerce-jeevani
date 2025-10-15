<?php

namespace Junk\WidgetResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Junk\WidgetResource;

class ListWidgets extends ListRecords
{
    protected static string $resource = WidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
