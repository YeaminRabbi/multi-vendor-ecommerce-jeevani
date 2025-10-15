<?php

namespace App\Filament\Clusters\Settings\Resources\SliderResource\Pages;

use App\Filament\Clusters\Settings\Resources\SliderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Pages\ListPosts;

class ListSliders extends ListPosts
{
    protected static string $resource = SliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
