<?php

namespace App\Filament\Clusters\Settings\Resources\PageResource\Pages;

use App\Filament\Clusters\Settings\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;
}
