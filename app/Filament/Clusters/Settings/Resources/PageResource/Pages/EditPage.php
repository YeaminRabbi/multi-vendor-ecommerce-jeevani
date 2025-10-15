<?php

namespace App\Filament\Clusters\Settings\Resources\PageResource\Pages;

use App\Filament\Clusters\Settings\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Pages\EditPost;

class EditPage extends EditPost
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
