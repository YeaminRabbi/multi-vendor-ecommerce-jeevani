<?php

namespace App\Filament\Clusters\Settings\Resources\SliderResource\Pages;

use App\Filament\Clusters\Settings\Resources\SliderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Pages\CreatePost;

class CreateSlider extends CreatePost
{
    protected static string $resource = SliderResource::class;
}
