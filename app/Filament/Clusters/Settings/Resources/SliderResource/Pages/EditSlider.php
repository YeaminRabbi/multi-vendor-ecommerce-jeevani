<?php

namespace App\Filament\Clusters\Settings\Resources\SliderResource\Pages;

use App\Filament\Clusters\Settings\Resources\SliderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Pages\EditPost;

class EditSlider extends EditPost
{
    protected static string $resource = SliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
