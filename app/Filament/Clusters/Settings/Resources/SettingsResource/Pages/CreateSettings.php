<?php

namespace App\Filament\Clusters\Settings\Resources\SettingsResource\Pages;

use App\Filament\Clusters\Settings\Resources\SettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSettings extends CreateRecord
{
    protected static string $resource = SettingsResource::class;
}
