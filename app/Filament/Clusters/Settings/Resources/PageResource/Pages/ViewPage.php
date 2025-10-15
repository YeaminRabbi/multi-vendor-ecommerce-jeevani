<?php

namespace App\Filament\Clusters\Settings\Resources\PageResource\Pages;

use App\Filament\Clusters\Settings\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPage extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;
    
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make()
        ];
    }
}
