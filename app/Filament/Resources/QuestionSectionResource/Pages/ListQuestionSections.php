<?php

namespace App\Filament\Resources\QuestionSectionResource\Pages;

use App\Filament\Resources\QuestionSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuestionSections extends ListRecords
{
    protected static string $resource = QuestionSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
